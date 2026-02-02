# Consolidate Less Variables Script
# Extracts all variables from YOOtheme's UIkit source files
# Outputs consolidated files in docs/uikit-less-consolidated/
#
# Source paths (YOOtheme vendor):
#   - Components: themes/yootheme/vendor/assets/uikit/src/less/components
#   - Theme:      themes/yootheme/vendor/assets/uikit/src/less/theme
#   - Master:     themes/yootheme/vendor/assets/uikit-themes/master
#   - YOOtheme:   themes/yootheme/less/theme.less (YOOtheme-specific variables)

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$pluginPath = Join-Path $scriptDir ".." | Resolve-Path
$wpContentPath = Join-Path $pluginPath "..\..\" | Resolve-Path
$yoothemePath = Join-Path $wpContentPath "themes\yootheme\vendor\assets"
$yoothemeLessPath = Join-Path $wpContentPath "themes\yootheme\less"

# Source paths (read from YOOtheme)
$componentPath = "$yoothemePath\uikit\src\less\components"
$themePath = "$yoothemePath\uikit\src\less\theme"
$masterPath = "$yoothemePath\uikit-themes\master"
$yoothemeThemeLess = "$yoothemeLessPath\theme.less"

# Output path (our plugin docs)
$docsPath = Join-Path $pluginPath "docs"
$outputPath = "$docsPath\uikit-less-consolidated"

# Source of truth for groups (existing consolidated files with your group annotations)
$existingGroupsPath = $outputPath

# Create output directory
if (!(Test-Path $outputPath)) {
    New-Item -ItemType Directory -Path $outputPath -Force | Out-Null
}

# Regex to match Less variable definitions
$variableRegex = '^\s*(@[a-zA-Z][a-zA-Z0-9_-]*)\s*:\s*(.+?)\s*;'
$groupRegex = '^\s*//\s*@group:\s*(.+)$'

# Function to extract existing group mappings from consolidated files
function Get-ExistingGroupMapping {
    param([string]$FilePath)
    
    $mapping = @{}
    
    if (!(Test-Path $FilePath)) {
        return $mapping
    }
    
    $content = Get-Content $FilePath -Raw
    $lines = $content -split "`n"
    $currentGroup = "Base"
    
    foreach ($line in $lines) {
        if ($line -match $groupRegex) {
            $currentGroup = $Matches[1].Trim()
        }
        
        if ($line -match '^\s*(@[a-zA-Z][a-zA-Z0-9_-]*)\s*:') {
            $varName = $Matches[1]
            $mapping[$varName] = $currentGroup
        }
    }
    
    return $mapping
}

function Extract-Variables {
    param(
        [string]$FilePath,
        [string]$Layer,
        [string]$SubFolder = ""
    )
    
    if (!(Test-Path $FilePath)) {
        return @()
    }
    
    $content = Get-Content $FilePath -Raw
    $lines = $content -split "`n"
    
    $variables = @()
    $currentGroup = "Base"
    
    foreach ($line in $lines) {
        # Check for group comment
        if ($line -match $groupRegex) {
            $currentGroup = $Matches[1].Trim()
        }
        
        # Check for variable definition
        if ($line -match $variableRegex) {
            $varName = $Matches[1]
            $varValue = $Matches[2].Trim()
            
            # Determine variable type
            $varType = "standard"
            if ($varName -match '^@internal-') {
                $varType = "internal"
            } elseif ($varName -match '^@inverse-') {
                $varType = "inverse"
            }
            
            # Determine group from subfolder if in master
            $group = $currentGroup
            if ($SubFolder -and $SubFolder -ne "base") {
                $group = (Get-Culture).TextInfo.ToTitleCase($SubFolder.Replace("-", " "))
            }
            
            $variables += [PSCustomObject]@{
                Name = $varName
                Value = $varValue
                Layer = $Layer
                SubFolder = $SubFolder
                Group = $group
                Type = $varType
            }
        }
    }
    
    return $variables
}

function Get-ComponentFiles {
    param([string]$ComponentName)
    
    $files = @()
    
    # Component layer
    $compFile = "$componentPath\$ComponentName"
    if (Test-Path $compFile) {
        $files += @{ Path = $compFile; Layer = "component"; SubFolder = "" }
    }
    
    # Theme layer
    $themeFile = "$themePath\$ComponentName"
    if (Test-Path $themeFile) {
        $files += @{ Path = $themeFile; Layer = "theme"; SubFolder = "" }
    }
    
    # Master layer - check all subfolders
    $masterSubFolders = @("base", "typo", "border", "border-radius", "box-shadow", "background-image", "transform")
    foreach ($subFolder in $masterSubFolders) {
        $masterFile = "$masterPath\$subFolder\$ComponentName"
        if (Test-Path $masterFile) {
            $files += @{ Path = $masterFile; Layer = "master"; SubFolder = $subFolder }
        }
    }
    
    return $files
}

# Get all unique component file names
$allComponents = @{}

# From component folder
Get-ChildItem -Path $componentPath -Filter "*.less" | ForEach-Object { $allComponents[$_.Name] = $true }

# From theme folder
Get-ChildItem -Path $themePath -Filter "*.less" | ForEach-Object { $allComponents[$_.Name] = $true }

# From master subfolders
$masterSubFolders = @("base", "typo", "border", "border-radius", "box-shadow", "background-image", "transform")
foreach ($subFolder in $masterSubFolders) {
    $subPath = "$masterPath\$subFolder"
    if (Test-Path $subPath) {
        Get-ChildItem -Path $subPath -Filter "*.less" -ErrorAction SilentlyContinue | ForEach-Object { 
            $allComponents[$_.Name] = $true 
        }
    }
}

Write-Host "Found $($allComponents.Count) unique components"

# Process each component
$allVariables = @{}

foreach ($componentFile in $allComponents.Keys | Sort-Object) {
    if ($componentFile -eq "_import.less") { continue }
    
    $componentName = $componentFile -replace '\.less$', ''
    Write-Host "Processing: $componentName"
    
    # Load existing group mapping from previously consolidated file (if exists)
    $existingGroupFile = "$existingGroupsPath\$componentFile"
    $existingGroups = Get-ExistingGroupMapping -FilePath $existingGroupFile
    
    $files = Get-ComponentFiles -ComponentName $componentFile
    $componentVars = @{}
    
    foreach ($file in $files) {
        $vars = Extract-Variables -FilePath $file.Path -Layer $file.Layer -SubFolder $file.SubFolder
        
        foreach ($var in $vars) {
            # Later layers override earlier ones, but keep track of all
            $key = $var.Name
            
            # Use existing group if available (preserves manual group assignments)
            $group = $var.Group
            if ($existingGroups.ContainsKey($key)) {
                $group = $existingGroups[$key]
            }
            
            if (!$componentVars.ContainsKey($key)) {
                $componentVars[$key] = @{
                    Name = $var.Name
                    Value = $var.Value
                    Group = $group
                    Type = $var.Type
                    Layers = @($var.Layer)
                }
            } else {
                # Update value (later layer overrides)
                $componentVars[$key].Value = $var.Value
                $componentVars[$key].Layers += $var.Layer
                # Keep existing group, or use more specific group from master subfolder
                if (!$existingGroups.ContainsKey($key) -and $var.SubFolder -and $var.SubFolder -ne "base") {
                    $componentVars[$key].Group = $var.Group
                }
            }
        }
    }
    
    if ($componentVars.Count -gt 0) {
        $allVariables[$componentName] = $componentVars
    }
}

# Generate consolidated output files
foreach ($component in $allVariables.Keys | Sort-Object) {
    $vars = $allVariables[$component]
    
    $output = @()
    $componentTitle = (Get-Culture).TextInfo.ToTitleCase($component.Replace('-', ' '))
    $output += "// Name:            $componentTitle"
    $output += "// Description:     Consolidated variables from component, theme, and master layers"
    $output += "//"
    $output += "// ========================================================================`n"
    $output += ""
    $output += "// Variables"
    $output += "// ========================================================================"
    
    # Group variables
    $grouped = @{}
    foreach ($varName in $vars.Keys | Sort-Object) {
        $var = $vars[$varName]
        $group = $var.Group
        if (!$grouped.ContainsKey($group)) {
            $grouped[$group] = @()
        }
        $grouped[$group] += $var
    }
    
    # Output by group
    foreach ($group in $grouped.Keys | Sort-Object) {
        $output += ""
        $output += "// @group: $group"
        
        $groupVars = $grouped[$group]
        
        # Separate by type: standard, internal, inverse
        $standard = $groupVars | Where-Object { $_.Type -eq "standard" } | Sort-Object { $_.Name }
        $internal = $groupVars | Where-Object { $_.Type -eq "internal" } | Sort-Object { $_.Name }
        $inverse = $groupVars | Where-Object { $_.Type -eq "inverse" } | Sort-Object { $_.Name }
        
        foreach ($var in $standard) {
            $layers = $var.Layers -join ", "
            $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
            $output += "$($var.Name):$padding$($var.Value); // [$layers]"
        }
        
        if ($internal.Count -gt 0) {
            $output += ""
            $output += "// Internal"
            foreach ($var in $internal) {
                $layers = $var.Layers -join ", "
                $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
                $output += "$($var.Name):$padding$($var.Value); // [$layers]"
            }
        }
        
        if ($inverse.Count -gt 0) {
            $output += ""
            $output += "// Inverse"
            foreach ($var in $inverse) {
                $layers = $var.Layers -join ", "
                $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
                $output += "$($var.Name):$padding$($var.Value); // [$layers]"
            }
        }
    }
    
    # Write file
    $outputFile = "$outputPath\$component.less"
    $output -join "`n" | Set-Content -Path $outputFile -Encoding UTF8
    Write-Host "  Created: $component.less ($($vars.Count) variables)"
}

# Create a master variables file with all variables
$masterOutput = @()
$masterOutput += "// Name:            All UIkit Variables"
$masterOutput += "// Description:     Complete consolidated variables from all components"
$masterOutput += "// Layers:          component -> theme -> master"
$masterOutput += "//"
$masterOutput += "// ========================================================================`n"

$totalVars = 0
foreach ($component in $allVariables.Keys | Sort-Object) {
    $vars = $allVariables[$component]
    $totalVars += $vars.Count
    
    $masterOutput += ""
    $masterOutput += "// ========================================================================"
    $masterOutput += "// $((Get-Culture).TextInfo.ToTitleCase($component.Replace('-', ' ')))"
    $masterOutput += "// ========================================================================"
    
    foreach ($varName in $vars.Keys | Sort-Object) {
        $var = $vars[$varName]
        $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
        $masterOutput += "$($var.Name):$padding$($var.Value);"
    }
}

$masterFile = "$outputPath\_all-variables.less"
$masterOutput -join "`n" | Set-Content -Path $masterFile -Encoding UTF8

# ========================================
# Process YOOtheme theme.less separately
# ========================================
Write-Host ""
Write-Host "Processing YOOtheme theme.less..."

if (Test-Path $yoothemeThemeLess) {
    # Load existing group mapping
    $existingYoothemeGroupFile = "$outputPath\yootheme-theme.less"
    $existingYoothemeGroups = Get-ExistingGroupMapping -FilePath $existingYoothemeGroupFile
    
    $yoothemeVars = @{}
    $content = Get-Content $yoothemeThemeLess -Raw
    $lines = $content -split "`n"
    
    $currentGroup = "Base"
    $currentSection = ""
    
    foreach ($line in $lines) {
        # Check for section comments like "// Page" or "// Toolbar"
        if ($line -match '^\s*//\s*$') {
            continue
        }
        if ($line -match '^\s*//\s*([A-Z][a-zA-Z ]+)\s*$') {
            $sectionName = $Matches[1].Trim()
            if ($sectionName -notmatch 'Variables|Internal|Inverse') {
                $currentSection = $sectionName
                $currentGroup = $sectionName
            }
        }
        
        # Check for group comment
        if ($line -match $groupRegex) {
            $currentGroup = $Matches[1].Trim()
        }
        
        # Check for variable definition
        if ($line -match $variableRegex) {
            $varName = $Matches[1]
            $varValue = $Matches[2].Trim()
            
            # Determine variable type
            $varType = "standard"
            if ($varName -match '^@internal-') {
                $varType = "internal"
            } elseif ($varName -match '^@inverse-') {
                $varType = "inverse"
            }
            
            # Use existing group if available
            $group = $currentGroup
            if ($existingYoothemeGroups.ContainsKey($varName)) {
                $group = $existingYoothemeGroups[$varName]
            }
            
            $yoothemeVars[$varName] = @{
                Name = $varName
                Value = $varValue
                Group = $group
                Type = $varType
            }
        }
    }
    
    if ($yoothemeVars.Count -gt 0) {
        $output = @()
        $output += "// Name:            YOOtheme Theme"
        $output += "// Description:     YOOtheme-specific theme variables (page, toolbar, header, etc.)"
        $output += "// Source:          themes/yootheme/less/theme.less"
        $output += "//"
        $output += "// ========================================================================`n"
        $output += ""
        $output += "// Variables"
        $output += "// ========================================================================"
        
        # Group variables
        $grouped = @{}
        foreach ($varName in $yoothemeVars.Keys | Sort-Object) {
            $var = $yoothemeVars[$varName]
            $group = $var.Group
            if (!$grouped.ContainsKey($group)) {
                $grouped[$group] = @()
            }
            $grouped[$group] += $var
        }
        
        # Define preferred group order
        $groupOrder = @(
            "Page", "Page Container", "Toolbar", "Header", "Sidebar",
            "Section", "Utility", "Mask", "Box Decoration", "Transition Border",
            "Base"
        )
        
        # Sort groups - known groups first in order, then alphabetically
        $sortedGroups = $grouped.Keys | Sort-Object {
            $idx = $groupOrder.IndexOf($_)
            if ($idx -ge 0) { $idx } else { 100 }
        }, { $_ }
        
        # Output by group
        foreach ($group in $sortedGroups) {
            $output += ""
            $output += "// @group: $group"
            
            $groupVars = $grouped[$group]
            
            # Separate by type: standard, internal, inverse
            $standard = $groupVars | Where-Object { $_.Type -eq "standard" } | Sort-Object { $_.Name }
            $internal = $groupVars | Where-Object { $_.Type -eq "internal" } | Sort-Object { $_.Name }
            $inverse = $groupVars | Where-Object { $_.Type -eq "inverse" } | Sort-Object { $_.Name }
            
            foreach ($var in $standard) {
                $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
                $output += "$($var.Name):$padding$($var.Value);"
            }
            
            if ($internal.Count -gt 0) {
                $output += ""
                $output += "// Internal"
                foreach ($var in $internal) {
                    $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
                    $output += "$($var.Name):$padding$($var.Value);"
                }
            }
            
            if ($inverse.Count -gt 0) {
                $output += ""
                $output += "// Inverse"
                foreach ($var in $inverse) {
                    $padding = " " * [Math]::Max(1, 60 - $var.Name.Length - $var.Value.Length)
                    $output += "$($var.Name):$padding$($var.Value);"
                }
            }
        }
        
        # Write file
        $yoothemeOutputFile = "$outputPath\yootheme-theme.less"
        $output -join "`n" | Set-Content -Path $yoothemeOutputFile -Encoding UTF8
        Write-Host "  Created: yootheme-theme.less ($($yoothemeVars.Count) variables)"
        
        $totalVars += $yoothemeVars.Count
    }
} else {
    Write-Host "  Warning: YOOtheme theme.less not found at $yoothemeThemeLess"
}

Write-Host ""
Write-Host "========================================="
Write-Host "Consolidation Complete!"
Write-Host "Total components: $($allVariables.Count)"
Write-Host "Total variables: $totalVars"
Write-Host "Output folder: $outputPath"
Write-Host "========================================="
