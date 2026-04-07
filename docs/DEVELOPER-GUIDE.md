# Developer Guide

Comprehensive reference for developing, extending, and maintaining the Enhanced Plugin Bundle and Theme Manager.

---

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Bootstrap & Initialization](#bootstrap--initialization)
3. [Autoloader & Naming Conventions](#autoloader--naming-conventions)
4. [Adding New Features](#adding-new-features)
5. [The Less Variable Pipeline](#the-less-variable-pipeline)
6. [When UIkit Updates — Full Recompilation Workflow](#when-uikit-updates--full-recompilation-workflow)
7. [Debugging Token Import/Export](#debugging-token-importexport)
8. [Debugging the Live Preview Compiler](#debugging-the-live-preview-compiler)
9. [CLI Tools Reference](#cli-tools-reference)
10. [Data Storage Reference](#data-storage-reference)
11. [Security Model](#security-model)
12. [Hooks Reference](#hooks-reference)
13. [Uninstall Behavior](#uninstall-behavior)

---

## Architecture Overview

The plugin is organized into 8 namespace areas under the `EPB\` root namespace:

```
EPB\
├── Admin\          # Admin page controller, menu registration, asset enqueue
├── Ajax\           # All AJAX endpoints (11 classes)
├── Core\           # Activation, deactivation, upgrades, constants, fonts, utilities
├── CSS\            # Less parsing, compilation, component registry, CSS generation
├── Plugins\        # Plugin bundle management (install/activate/deactivate/delete)
├── Themes\         # Theme uploads, child theme generation
├── Themes\Renderer\# UI rendering (component picker fields, previews)
└── Tokens\         # Tokens Studio (Figma) import/export
```

### Key Classes by Role

| Role              | Class                            | Description                                                |
| ----------------- | -------------------------------- | ---------------------------------------------------------- |
| **Bootstrap**     | `enhanced-plugin-bundle.php`     | Defines constants, loads autoloader, hooks `epb_init()`    |
| **Constants**     | `EPB\Core\Constants`             | All option keys, nonce actions, cache keys, defaults       |
| **AJAX Hub**      | `EPB\Ajax\Handler`               | Registers all AJAX hooks, delegates to specialized classes |
| **Component Hub** | `EPB\Ajax\Component_Handler`     | Coordinates component AJAX + global settings               |
| **Registry**      | `EPB\CSS\Component_Registry`     | Maps 74 components to 11 categories with metadata          |
| **Less Parser**   | `EPB\CSS\Less_Parser`            | Extracts variables from consolidated Less files            |
| **Less Compiler** | `EPB\CSS\Less_Compiler`          | Wraps `wikimedia/less.php` with preprocessing              |
| **Less Builder**  | `EPB\CSS\Component_Less_Builder` | Assembles full Less source for compilation                 |
| **CSS Generator** | `EPB\CSS\Generator`              | Produces CSS custom properties + fluid typography          |
| **Child Theme**   | `EPB\Themes\Child_Theme`         | Generates and maintains the child theme files              |

---

## Bootstrap & Initialization

The plugin boots in this order:

```
enhanced-plugin-bundle.php
  ├── Define constants (EPB_VERSION, EPB_PLUGIN_DIR, EPB_PLUGIN_URL, EPB_PLUGIN_BASENAME)
  ├── require vendor/class-tgm-plugin-activation.php
  ├── require includes/class-autoloader.php → EPB_Autoloader::register()
  └── add_action('plugins_loaded', 'epb_init')
        ├── load_plugin_textdomain()
        ├── EPB\Core\Upgrader::maybe_upgrade()
        ├── EPB\Core\Notices::init()
        ├── EPB\Admin\Controller::init()
        │     ├── admin_menu → register_admin_menu()
        │     ├── admin_enqueue_scripts → enqueue_assets()
        │     └── admin_init → handle_form_submissions()
        ├── EPB\Ajax\Handler::init()
        │     ├── Plugin AJAX (epb_plugin_action, epb_get_plugin_status)
        │     ├── Token AJAX (epb_export_figma, epb_import_figma)
        │     ├── Child Theme AJAX (epb_create_child_theme)
        │     ├── Component_Handler::register() → 15+ component AJAX actions
        │     ├── Preview_Compiler::register() → epb_compile_preview
        │     └── Font_Handler::register() → 7 font AJAX actions
        ├── EPB\Themes\Child_Theme::init()
        ├── EPB\Core\Adobe_Font::init()
        ├── EPB\Core\Custom_Font::init()
        └── EPB\Core\Google_Font::init()
```

---

## Autoloader & Naming Conventions

The autoloader (`EPB_Autoloader`) maps the `EPB\` namespace to `includes/` using these conventions:

### Class → File Mapping

| Fully Qualified Class                  | File Path                                             |
| -------------------------------------- | ----------------------------------------------------- |
| `EPB\Ajax\Handler`                     | `includes/Ajax/class-handler.php`                     |
| `EPB\Ajax\Plugin_Actions`              | `includes/Ajax/class-plugin-actions.php`              |
| `EPB\Core\Custom_Font`                 | `includes/Core/class-custom-font.php`                 |
| `EPB\CSS\Less_Compiler`                | `includes/CSS/class-less-compiler.php`                |
| `EPB\Themes\Renderer\Dynamic_Renderer` | `includes/Themes/Renderer/class-dynamic-renderer.php` |

### Rules

1. Strip the `EPB\` prefix
2. Namespace parts become directories: `Ajax\` → `Ajax/`
3. Class name is lowercased and hyphenated: `Plugin_Actions` → `plugin-actions`
4. Prefix with `class-`: → `class-plugin-actions.php`
5. CamelCase splits: `CustomFont` → `custom-font` (but we use `Custom_Font` → `custom-font`)

### Coding Conventions

- **All classes are static-only** — no instantiation, no constructors (except `Less_Compiler`)
- **Method naming**: `snake_case` for all methods
- **Direct access protection**: Every PHP file starts with an `ABSPATH` or `add_filter` check
- **Types**: PHP 7.4+ typed properties and return types throughout
- **Text domain**: `enhanced-plugin-bundle` for all translatable strings

---

## Adding New Features

### Adding a New AJAX Endpoint

1. **Create a class** in `includes/Ajax/`:

```php
<?php
namespace EPB\Ajax;

use EPB\Core\Constants;

class My_Feature
{
    public static function register(): void
    {
        add_action('wp_ajax_epb_my_action', [self::class, 'handle']);
    }

    public static function handle(): void
    {
        // Always verify nonce + capability first
        if (!Handler::verify_request(Constants::NONCE_ACTION)) {
            return;
        }

        $param = Handler::get_post_param('my_param');

        // ... your logic ...

        wp_send_json_success(['message' => __('Done.', 'enhanced-plugin-bundle')]);
    }
}
```

2. **Register it** in `Handler::init()` or `Component_Handler::register()`:

```php
// In Handler::init():
My_Feature::register();
```

3. **Call from JavaScript** — use the existing AJAX pattern in `component-picker.js` or `admin.js`:

```js
jQuery.post(ajaxurl, {
    action: 'epb_my_action',
    nonce: epbComponentPicker.nonce,
    my_param: 'value'
}, function(response) { ... });
```

### Adding a New WordPress Option

1. **Add the constant** to `EPB\Core\Constants`:

```php
public const OPTION_MY_FEATURE = 'epb_my_feature';
public const DEFAULT_MY_FEATURE = 'default_value';
```

2. **Add a save handler** (AJAX or form-based)

3. **Add cleanup** to `uninstall.php`:

```php
delete_option('epb_my_feature');
```

### Adding a New UIkit Component

1. **Create the consolidated Less file** at `docs/uikit-less-consolidated/{component}.less` with `@group` annotations:

```less
// @group: Colors
@mycomponent-color: @global-color;
@mycomponent-background: @global-background;

// @group: Sizing
@mycomponent-padding: 20px;
```

2. **Register in Component Registry** — add to `COMPONENTS` array in `includes/CSS/class-component-registry.php`:

```php
'mycomponent' => [
    'label'       => 'My Component',
    'icon'        => 'admin-generic',  // WordPress dashicon name
    'description' => 'Description shown in the component picker',
    'category'    => 'elements',       // Must match a key in CATEGORIES
],
```

3. **Add a preview** (optional) — add a `preview_mycomponent()` method to `includes/Themes/Renderer/class-preview-renderer.php`

### Adding a New Category

Add to `CATEGORIES` in `includes/CSS/class-component-registry.php`:

```php
'mycategory' => [
    'label' => 'My Category',
    'icon'  => 'dashicon-name',
    'order' => 12,  // Controls sidebar sort order
],
```

### Adding a Version Migration

Add a version check in `EPB\Core\Upgrader::maybe_upgrade()`:

```php
if (version_compare($stored_version, '5.0', '<')) {
    self::upgrade_to_5_0();
}
```

Then implement the migration method:

```php
private static function upgrade_to_5_0(): void
{
    // Migrate data, update options, clear caches...
    self::clear_cache_and_log('5.0');
}
```

Remember to bump `EPB_VERSION` in `enhanced-plugin-bundle.php` and the plugin header.

---

## The Less Variable Pipeline

### UIkit's Three Layers

YOOtheme bundles UIkit with a three-layer variable system. Each layer can override variables from the previous:

```
Layer 1: Component (UIkit defaults)
    └── vendor/yootheme/.../uikit/src/less/components/
Layer 2: Theme (YOOtheme customizations)
    └── vendor/yootheme/.../uikit-theme/
Layer 3: Master (Final overrides)
    └── vendor/yootheme/.../uikit-theme/master/
        ├── base/
        ├── typo/
        ├── border/
        ├── border-radius/
        ├── box-shadow/
        ├── background-image/
        └── transform/
```

A variable like `@button-primary-background` might be:

- **Component layer**: `#1e87f0` (UIkit default)
- **Theme layer**: `@global-primary-background` (YOOtheme remaps to global)
- **Master layer**: not overridden (theme value wins)

The **final value** used is the last layer to define it.

### Consolidation

The `consolidate-less-variables.ps1` script merges all three layers into single files per component in `docs/uikit-less-consolidated/`. This is the **source of truth** for the plugin.

```
docs/uikit-less-consolidated/
├── _all-variables.less    # Every variable from every component (master import file)
├── variables.less         # Global variables
├── base.less              # Base component
├── button.less            # Button component
├── card.less              # Card component
└── ... (72 files total)
```

Each file contains variables with `@group` annotations for UI organization:

```less
// @group: Colors
@button-primary-background: @global-primary-background;
@button-primary-color: @global-inverse-global-color;

// @group: Sizing
@button-padding-horizontal: 30px;
@button-line-height: 38px;
```

### How Variables Flow to CSS

```
Consolidated Less files (docs/uikit-less-consolidated/*.less)
    │
    ▼
Less_Parser::parse_component()        ← Extracts variables with metadata
    │                                    (name, value, type, group, resolved value)
    ▼
Component_Registry::get_component()   ← Adds UI metadata (label, icon, category)
    │
    ▼
Dynamic_Renderer::render_component_fields()  ← Renders form fields in admin UI
    │
    ▼  [User makes changes]
    │
Component_Saver::save_component()     ← Sanitizes, filters defaults, saves to wp_options
    │
    ▼
Component_Handler::regenerate_css()   ← Clears transient, fires action
    │
    ├──▶ Generator::generate_all_component_css()  ← CSS custom properties + fluid typography
    │        └──▶ Writes to child theme css/custom.css
    │
    └──▶ Child_Theme::regenerate_custom_css()     ← Also generates Less for YOOtheme
             └──▶ Writes to child theme less/theme.ct-style.less
```

### Server-Side Less Compilation (Preview)

For live preview, the compilation pipeline is:

```
Component_Less_Builder::build_for_preview()
    ├── Load _all-variables.less          (all consolidated variables)
    ├── Load UIkit mixins                  (mixin definitions)
    ├── Generate empty hook stubs          (prevents "undefined mixin" errors)
    ├── Load UIkit component Less rules    (the actual CSS rules)
    ├── Apply user variable overrides      (from the editor form)
    └── Re-assert inherited references     (cascade fix for overridden globals)
         │
         ▼
Less_Compiler::compile()
    ├── Preprocessing:
    │   ├── Remove BOM characters
    │   ├── Convert // comments to /* */
    │   ├── Escape :is(), :where(), :has() pseudo-classes
    │   ├── Escape color functions with var() references
    │   ├── Expand 2-arg rgba() to 4-arg form
    │   └── Extract @property blocks
    ├── wikimedia/less.php compilation
    └── Return CSS string
```

### Reference Re-Assertions

This is a critical feature. When a user overrides a global variable like `@global-background`, UIkit's theme layer may have remapped component variables:

```less
// UIkit component layer:
@dropbar-background: @global-background;

// UIkit theme layer (overrides the reference!):
@dropbar-background: @global-muted-background;
```

If the user sets `@global-background: #333`, they'd expect `@dropbar-background` to also change — but it won't because the theme layer changed the reference.

The re-assertion system in `Component_Less_Builder` and `Child_Theme` scans all components for variables that reference overridden globals and re-asserts the original reference chain so user changes cascade correctly.

---

## When UIkit Updates — Full Recompilation Workflow

When YOOtheme Pro is updated (new UIkit version), follow this process:

### Step 1: Sync Group Annotations

UIkit updates may rewrite source Less files, removing your `@group` annotations. Re-apply them:

```bash
# Dry-run first (shows what would change):
php tools/sync-less-groups.php

# Apply changes:
php tools/sync-less-groups.php --apply

# Filter to a specific component:
php tools/sync-less-groups.php --apply --component=button
```

This reads group mappings from your consolidated files and writes `// @group: GroupName` comments back into the YOOtheme source files.

### Step 2: Reconsolidate Variables

Extract all variables from all three UIkit layers and merge into consolidated files:

```powershell
.\tools\consolidate-less-variables.ps1
```

This will:

- Read all YOOtheme UIkit source files across Component, Theme, and Master layers
- Preserve existing `@group` annotations from previously consolidated files
- Output updated `.less` files to `docs/uikit-less-consolidated/`
- Generate `_all-variables.less` master file

### Step 3: Audit Group Annotations

Check if any new variables are missing `@group` annotations:

```bash
php tools/add-less-groups.php
```

Output shows:

- `✓` — all variables grouped
- `⚠` — some variables ungrouped (need manual annotation)
- `○` — no variables in file

### Step 4: Add Missing Groups

For any files with `⚠`, open the consolidated Less file and add `// @group: GroupName` annotations above ungrouped variables. Common groups:

| Group        | Used For                               |
| ------------ | -------------------------------------- |
| `Colors`     | Background, text, border colors        |
| `Sizing`     | Width, height, padding, margin         |
| `Typography` | Font family, size, weight, line height |
| `Border`     | Border width, radius, style            |
| `Spacing`    | Internal padding, margins, gutters     |
| `Animation`  | Transitions, durations, timing         |

After adding annotations, re-run consolidation (Step 2) then audit again (Step 3) until all variables are grouped.

### Step 5: Regenerate Documentation

```bash
php tools/generate-variables-doc.php
```

Outputs `docs/UIKIT-VARIABLES.md` with:

- Summary table of all components and variable counts
- Layer explanation
- Detailed per-component sections grouped by category
- Appendix of overridden variables with layer-by-layer values

### Step 6: Update Component Examples

```bash
# Interactive mode (prompts for each component):
php tools/download-uikit-examples.php

# Auto-generate preview methods:
php tools/download-uikit-examples.php --generate
```

This fetches official UIkit documentation examples from GitHub and saves them to `docs/uikit-examples/`.

### Step 7: Merge Preview Methods

```bash
php tools/merge-previews.php
```

This reads `_generated-previews.php` (from Step 6) and outputs `class-preview-renderer-new.php`. Review the output, then replace the existing file.

### Step 8: Register New Components

If UIkit added new components, add entries to `Component_Registry::COMPONENTS` (see [Adding a New UIkit Component](#adding-a-new-uikit-component)).

### Step 9: Test

1. Load the WordPress admin → Plugin Bundle → Component Picker
2. Verify all components appear in the sidebar with correct categories
3. Open each new/changed component and verify variables load with proper grouping
4. Test preview compilation
5. Save changes and verify CSS regeneration

### Quick Reference

```bash
# Full pipeline after UIkit update:
php tools/sync-less-groups.php --apply
.\tools\consolidate-less-variables.ps1
php tools/add-less-groups.php
# (fix any ungrouped variables manually)
php tools/generate-variables-doc.php
php tools/download-uikit-examples.php --generate
php tools/merge-previews.php
```

---

## Debugging Token Import/Export

### Export Debugging

The exporter (`EPB\Tokens\Tokens_Studio_Exporter`) follows this flow:

```
export()
  ├── parse_less_files()         ← Reads all docs/uikit-less-consolidated/*.less
  ├── apply_saved_overrides()    ← Overlays wp_options values on defaults
  └── build_tokens()             ← Converts to Tokens Studio format
        ├── detect_token_type()  ← Name-based type detection
        ├── parse_value()        ← Converts @references to {references}
        └── parse_color_function() ← Converts lighten() etc. to modify format
```

**Common export issues:**

| Symptom                       | Cause                                                                     | Fix                                                                                                                              |
| ----------------------------- | ------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| Variable missing from export  | `detect_token_type()` returned `other`                                    | Check the type detection rules — `other` type tokens are excluded from export. The variable name may not match any known pattern |
| Wrong token type              | Name-based detection matched wrong pattern                                | Check the priority order in `detect_token_type()` — special cases (color-mode, opacity) are checked first, then general patterns |
| Color function not converted  | `parse_color_function()` only handles simple and 2-level nested functions | For complex expressions, the raw value passes through to `parse_value()` instead                                                 |
| CSS keyword not exported      | Keywords like `transparent`, `inherit` need special handling              | Check the CSS keyword block in `build_tokens()` — unresolvable keywords are skipped                                              |
| Saved overrides not reflected | Overrides applied but `value` still shows default                         | Check `apply_saved_overrides()` — it only overrides non-empty saved values                                                       |

**To debug the export**, add temporary logging to `build_tokens()`:

```php
error_log('[EPB Export] Variable: ' . $name . ' | Value: ' . $value . ' | Type: ' . $type);
```

### Import Debugging

The importer (`EPB\Tokens\Tokens_Studio_Importer`) returns a `debug_logs` array in the AJAX response. To inspect it:

1. Open browser DevTools → Network tab
2. Trigger the import in the admin UI
3. Find the `admin-ajax.php` request with action `epb_import_figma`
4. Check the response JSON → `data.debug_logs`

The import flow:

```
import_figma (AJAX endpoint in Token_Actions)
  ├── JSON decode + validate
  ├── Tokens_Studio_Importer::validate()    ← Structure check
  └── Tokens_Studio_Importer::import()
        ├── build_token_lookup()             ← Maps token names to set names
        ├── For each group (skips $themes, $metadata):
        │   ├── Check $extensions.epb.less   ← Round-trip CSS keyword restoration
        │   ├── Check studio.tokens.modify   ← Convert color modifiers to Less functions
        │   ├── convert_references_to_less() ← {var} → @var
        │   ├── build_uikit_variable_name()  ← Ensures proper prefix
        │   └── get_target_component()       ← Routes to correct component
        ├── filter_modified_values()         ← Removes values matching UIkit defaults
        └── update_option() per component
```

**Common import issues:**

| Symptom                       | Cause                                                     | Fix                                                                                                                                                               |
| ----------------------------- | --------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| 0 tokens imported             | JSON structure invalid                                    | Validate JSON, check for `value`+`type` properties on tokens                                                                                                      |
| Token goes to wrong component | `get_target_component()` uses first part of variable name | Check the component map — `global-*` → `variables`, `base-*` → `base`, `breakpoint-*` → `variables`                                                               |
| CSS keyword lost              | `$extensions.epb.less` metadata stripped by Figma         | Preserve extensions during Figma editing; if lost, keywords can't be round-tripped                                                                                |
| Color function lost           | `description` field with `Less: ...` was stripped         | The importer checks `description` for original Less expression — preserve it in Figma                                                                             |
| Value saved but not visible   | `filter_modified_values()` detected value matches default | The filter uses `Utils::is_value_modified()` which normalizes escape syntax and compares colors — check if the imported value truly differs from the Less default |
| Duplicate variable prefix     | Token name already has component prefix                   | `build_uikit_variable_name()` checks if the token name starts with the group — if so, it doesn't double-prefix                                                    |

### Testing Round-Trip Fidelity

1. Export from WordPress → save JSON
2. Import the same JSON back
3. Check `debug_logs` for "Restored CSS value" entries (CSS keywords should be restored)
4. Export again → compare with original JSON
5. Differences indicate round-trip issues — check `$extensions` preservation

---

## Debugging the Live Preview Compiler

The preview compiler (`EPB\Ajax\Preview_Compiler`) accepts a `debug` parameter:

### Enabling Debug Mode

In the AJAX request for `epb_compile_preview`, add `debug=1`:

```js
jQuery.post(ajaxurl, {
    action: 'epb_compile_preview',
    nonce: epbComponentPicker.nonce,
    component: 'button',
    overrides: JSON.stringify({...}),
    debug: 1
});
```

The debug response includes:

- **timestamp** — when compilation ran
- **override_keys** — which variables were overridden
- **requirements_check** — UIkit/YOOtheme file existence
- **uikit_source_exists** — whether the component's Less source file was found
- **less_source_length** — size of assembled Less
- **error_context** — on failure: line number, surrounding code (5 lines before/after)

### Common Compilation Errors

| Error                                   | Cause                                  | Fix                                                                                     |
| --------------------------------------- | -------------------------------------- | --------------------------------------------------------------------------------------- |
| `NameError: variable @xyz is undefined` | Variable not in consolidated files     | Add the variable to the component's consolidated Less file                              |
| `ParseError: Unrecognised input`        | Modern CSS syntax Less can't handle    | Check that `Less_Compiler` preprocessing handles it — may need to add a new escape rule |
| `variable @hook-* is undefined`         | Missing mixin hook stub                | Check `Component_Less_Builder::build()` generates the hook stub                         |
| Preview shows no styles                 | Compilation succeeded but CSS is empty | Check that the component's UIkit Less file includes CSS rules, not just variables       |

### Less Compiler Preprocessing

The `Less_Compiler` preprocesses Less source before passing to `wikimedia/less.php`. If you encounter a new CSS feature that breaks compilation, add preprocessing in `Less_Compiler::preprocess()`:

1. BOM removal
2. `//` comments → `/* */`
3. `:is()`, `:where()`, `:has()` pseudo-class escaping
4. Color functions with `var()` references
5. 2-arg `rgba()` → 4-arg expansion
6. `@property` block extraction

---

## CLI Tools Reference

All tools are in the `tools/` directory. Run from the plugin root.

### consolidate-less-variables.ps1

**Purpose**: Extracts all UIkit Less variables from YOOtheme's three source layers and merges them into consolidated files.

**Runtime**: PowerShell

```powershell
.\tools\consolidate-less-variables.ps1
```

**Input**: YOOtheme source directories (Component, Theme, Master layers)

**Output**: `docs/uikit-less-consolidated/*.less` (72 files + `_all-variables.less`)

**Behavior**:

- Preserves existing `@group` annotations from previously consolidated files
- Categorizes variables as standard, internal, or inverse
- Generates one `.less` file per component
- Creates `_all-variables.less` master import file

---

### sync-less-groups.php

**Purpose**: Re-applies `@group` annotations from consolidated files back to YOOtheme source files after UIkit updates.

```bash
# Dry-run (shows changes without applying):
php tools/sync-less-groups.php

# Apply changes:
php tools/sync-less-groups.php --apply

# Filter to a specific component:
php tools/sync-less-groups.php --component=button

# Combine:
php tools/sync-less-groups.php --apply --component=button
```

**Input**: `docs/uikit-less-consolidated/*.less` (reads group mappings)

**Output**: Modified YOOtheme source files (writes `@group` comments)

---

### add-less-groups.php

**Purpose**: Audits consolidated Less files for proper `@group` annotation coverage.

```bash
php tools/add-less-groups.php
```

**Output**: Per-file status report:

- `✓` — all variables have group annotations
- `⚠` — some variables missing annotations (lists them)
- `○` — file has no variables

**Skips**: Files starting with `_`, variables prefixed with `@internal-` or `@hook-`

---

### generate-variables-doc.php

**Purpose**: Auto-generates comprehensive variable reference documentation.

```bash
php tools/generate-variables-doc.php
```

**Output**: `docs/UIKIT-VARIABLES.md`

**Content**:

- Summary table (component names, variable counts, override counts)
- Layer explanation
- Per-component sections with variables grouped by category
- Overridden variables marked with ⚡
- Appendix showing layer-by-layer values for overridden variables

---

### download-uikit-examples.php

**Purpose**: Fetches official UIkit component examples from GitHub documentation.

```bash
# Interactive (prompts per component):
php tools/download-uikit-examples.php

# Auto-generate preview methods:
php tools/download-uikit-examples.php --generate
```

**Source**: GitHub raw content from `uikit-site/develop/docs/pages/`

**Output**:

- `docs/uikit-examples/{component}.md` — raw documentation
- `docs/uikit-examples/{component}-examples.json` — extracted code examples
- `docs/uikit-examples/_summary.json` — overview with counts
- `docs/uikit-examples/_generated-previews.php` — PHP preview methods (with `--generate`)

---

### merge-previews.php

**Purpose**: Merges generated preview methods into the `Preview_Renderer` class.

```bash
php tools/merge-previews.php
```

**Input**: `docs/uikit-examples/_generated-previews.php`

**Output**: `includes/Themes/Renderer/class-preview-renderer-new.php`

Review the output file, then replace the existing `class-preview-renderer.php` if it looks correct.

---

### compile-mo.php

**Purpose**: Compiles `.po` translation files to binary `.mo` format.

```bash
php tools/compile-mo.php
```

**Input**: `languages/*.po`

**Output**: `languages/*.mo`

Handles multiline strings, escape sequences (`\n`, `\r`, `\t`, `\"`, `\\`), and proper MO binary format with offset tables.

---

## Data Storage Reference

### WordPress Options

| Option Key                         | Type     | Description                                                                                  |
| ---------------------------------- | -------- | -------------------------------------------------------------------------------------------- |
| `epb_component_{name}`             | `array`  | Per-component variable overrides (`variable_name => value`)                                  |
| `epb_dynamic_plugins`              | `array`  | Plugin bundle list                                                                           |
| `epb_version`                      | `string` | Stored plugin version for upgrade detection                                                  |
| `epb_fluid_scale_ratio`            | `string` | General fluid typography scale ratio (default: `0.85`)                                       |
| `epb_fluid_scale_ratio_navbar`     | `string` | Navbar scale ratio (default: `0.85`)                                                         |
| `epb_fluid_scale_ratio_nav`        | `string` | Navigation scale ratio (default: `0.85`)                                                     |
| `epb_fluid_scale_ratio_navbar_gap` | `string` | Navbar gap scale ratio (default: `0.50`)                                                     |
| `epb_hyphenation_enabled`          | `string` | CSS hyphenation toggle (`0`/`1`)                                                             |
| `epb_adobe_font_enabled`           | `string` | Adobe Fonts toggle (`0`/`1`)                                                                 |
| `epb_adobe_font_url`               | `string` | Adobe Fonts CSS URL                                                                          |
| `epb_custom_fonts`                 | `array`  | Custom font metadata (id, family, file, ext, weights, style)                                 |
| `epb_google_fonts`                 | `array`  | Google Fonts configuration (family, weights)                                                 |
| `epb_branding`                     | `array`  | Child theme branding (theme_name, company_name, company_url, logo_url, description, version) |
| `epb_needs_recompile`              | `bool`   | Flag for YOOtheme to trigger CSS recompilation                                               |

### Transients

| Key                 | Duration | Description          |
| ------------------- | -------- | -------------------- |
| `epb_component_css` | 1 hour   | Cached generated CSS |
| `epb_plugin_cache`  | varies   | Plugin status cache  |

### File Storage

| Path                                                             | Description                               |
| ---------------------------------------------------------------- | ----------------------------------------- |
| `/wp-content/uploads/epb-fonts/`                                 | Custom font files (WOFF2, WOFF, TTF, OTF) |
| `/wp-content/uploads/epb-fonts/.htaccess`                        | Directory protection                      |
| `/wp-content/themes/YOOthemechildtheme/`                         | Generated child theme                     |
| `/wp-content/themes/YOOthemechildtheme/css/custom.css`           | Generated CSS                             |
| `/wp-content/themes/YOOthemechildtheme/less/theme.ct-style.less` | Generated Less for YOOtheme               |

---

## Security Model

### Capabilities

Three custom capabilities registered on the `administrator` role:

| Capability            | Purpose                                       |
| --------------------- | --------------------------------------------- |
| `epb_manage_plugins`  | Install, activate, deactivate, delete plugins |
| `epb_manage_themes`   | Upload themes, create child themes            |
| `epb_access_settings` | Access plugin settings page                   |

All AJAX endpoints fall back to `manage_options` capability check via `Handler::verify_request()`.

### AJAX Security

Every AJAX handler follows this pattern:

```php
public static function handle(): void
{
    // 1. Verify nonce AND capability
    if (!Handler::verify_request(Constants::NONCE_ACTION)) {
        return; // Sends JSON error automatically
    }

    // 2. Sanitize all input
    $param = Handler::get_post_param('key');           // sanitize_text_field
    $component = sanitize_key($_POST['component']);     // alphanumeric + hyphens
    $color = sanitize_hex_color($value);               // #ffffff format

    // 3. Validate against known values
    if (!Component_Registry::has_component($component)) {
        wp_send_json_error([...]);
        return;
    }

    // 4. Process and respond
}
```

### Input Sanitization

The `Component_Saver::sanitize_component_values()` method sanitizes by field type:

| Type                         | Sanitization                                                  |
| ---------------------------- | ------------------------------------------------------------- |
| `color`                      | `sanitize_hex_color()`, falls back to `sanitize_text_field()` |
| `size`, `number`, `duration` | `sanitize_text_field()`                                       |
| `font-weight`                | Validated against CSS keywords + numeric 100-900 range        |
| `font`                       | `wp_strip_all_tags(stripslashes())`                           |
| default                      | `wp_strip_all_tags(stripslashes())`                           |

### Font Upload Validation

`Custom_Font::upload()` validates by **magic bytes** (not just file extension):

| Format | Magic Bytes        |
| ------ | ------------------ |
| WOFF2  | `wOF2`             |
| WOFF   | `wOFF`             |
| TTF    | `\x00\x01\x00\x00` |
| OTF    | `OTTO`             |

Maximum file size: 5 MB.

---

## Hooks Reference

### Actions

```php
// Fired when component settings are saved or CSS needs regeneration.
// Triggers child theme CSS/Less file regeneration.
do_action('epb_component_settings_updated');
do_action('epb_component_settings_updated', $component, $settings);
```

### Filters

```php
// Customize the child theme style.css header.
apply_filters('epb_child_theme_header', array $header);

// Customize child theme branding (logo, company info).
apply_filters('epb_child_theme_branding', array $branding);

// Customize the Less style metadata (name, colors, dark/light type).
apply_filters('epb_less_style_metadata', array $metadata);
```

### AJAX Actions

| Action                       | Handler                                     | Description                               |
| ---------------------------- | ------------------------------------------- | ----------------------------------------- |
| `epb_plugin_action`          | `Plugin_Actions::handle_action`             | Plugin install/activate/deactivate/delete |
| `epb_get_plugin_status`      | `Plugin_Actions::get_status`                | Get plugin status                         |
| `epb_export_figma`           | `Token_Actions::export_figma`               | Export tokens for Figma                   |
| `epb_import_figma`           | `Token_Actions::import_figma`               | Import tokens from Figma                  |
| `epb_create_child_theme`     | `Child_Theme_Actions::create`               | Create/update child theme                 |
| `epb_load_component`         | `Component_Loader::load_component`          | Load component fields                     |
| `epb_get_components_menu`    | `Component_Loader::get_components_menu`     | Get sidebar menu data                     |
| `epb_get_component_preview`  | `Component_Loader::get_component_preview`   | Get preview HTML                          |
| `epb_get_preview_page`       | `Component_Loader::get_preview_page`        | Full preview page (iframe)                |
| `epb_save_component`         | `Component_Saver::save_component`           | Save component variables                  |
| `epb_reset_component`        | `Component_Saver::reset_component`          | Reset component to defaults               |
| `epb_reset_field`            | `Component_Saver::reset_field`              | Reset single field                        |
| `epb_reset_all_components`   | `Component_Saver::reset_all_components`     | Reset everything                          |
| `epb_export_all_components`  | `Component_Exporter::export_all_components` | Export all settings (JSON)                |
| `epb_export_yootheme_less`   | `Component_Exporter::export_yootheme_less`  | Export as YOOtheme style JSON             |
| `epb_import_components`      | `Component_Importer::import_components`     | Import settings (JSON)                    |
| `epb_compile_preview`        | `Preview_Compiler::compile`                 | Server-side Less compilation              |
| `epb_resolve_variable`       | `Component_Handler::resolve_variable`       | Resolve Less variable reference           |
| `epb_save_fluid_scale_ratio` | `Component_Handler::save_fluid_scale_ratio` | Save fluid typography ratios              |
| `epb_save_adobe_font`        | `Component_Handler::save_adobe_font`        | Save Adobe Font settings                  |
| `epb_save_hyphenation`       | `Component_Handler::save_hyphenation`       | Save hyphenation toggle                   |
| `epb_save_branding`          | `Component_Handler::save_branding`          | Save child theme branding                 |
| `epb_upload_custom_font`     | `Font_Handler::upload_font`                 | Upload custom font file                   |
| `epb_delete_custom_font`     | `Font_Handler::delete_font`                 | Delete custom font                        |
| `epb_update_custom_font`     | `Font_Handler::update_font`                 | Update font weights/style                 |
| `epb_get_custom_fonts`       | `Font_Handler::get_fonts`                   | Retrieve all custom fonts                 |
| `epb_add_google_font`        | `Font_Handler::add_google_font`             | Add Google Font                           |
| `epb_update_google_font`     | `Font_Handler::update_google_font`          | Update Google Font weights                |
| `epb_delete_google_font`     | `Font_Handler::delete_google_font`          | Delete Google Font                        |

---

## Uninstall Behavior

When the plugin is **deleted** (not just deactivated), `uninstall.php` runs:

**Removed:**

- `epb_dynamic_plugins` option
- `epb_version` option
- `ppm_child_theme_css_options` (legacy option)
- All `epb_component_*` options (pattern-based deletion via SQL)
- `epb_plugin_cache` transient
- `epb_custom_fonts` option
- `epb_google_fonts` option
- Custom capabilities from administrator role

**Intentionally preserved:**

- Child theme directory (`/wp-content/themes/YOOthemechildtheme/`) — may contain user customizations
- Custom font files (`/wp-content/uploads/epb-fonts/`) — preserved for safety
- Other plugin options (branding, fluid ratios, etc.) — add to `uninstall.php` if they should be cleaned up

---

## Further Documentation

| Document                                                     | Description                             |
| ------------------------------------------------------------ | --------------------------------------- |
| [tokens-studio-setup.md](tokens-studio-setup.md)             | Tokens Studio / Figma integration guide |
| [UIKIT-VARIABLES.md](UIKIT-VARIABLES.md)                     | Auto-generated UIkit variable reference |
| [COLOR-VARIABLES.md](COLOR-VARIABLES.md)                     | Color variable reference                |
| [FONT-TYPOGRAPHY-VARIABLES.md](FONT-TYPOGRAPHY-VARIABLES.md) | Font and typography variable reference  |
| [MARGIN-PADDING-VARIABLES.md](MARGIN-PADDING-VARIABLES.md)   | Margin and padding variable reference   |
