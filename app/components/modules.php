<?php

/**
 * Module system
 * 
 * @package mini_blog
 */
function modules ($key = null, $value = null) {
    static $repo = null;
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Don't confuse this function with module_load
 * This function loads all modules in app/modules,
 * but module_load loads one seperate module.
 * 
 * Load all modules
 */
function modules_load (array $modules) {
    foreach ($modules as $key => $module) {
        $file = app_path("modules/$module/module");
        
        if (!file_exists("$file.php")) {
            continue;
        }
        
        load_php($file);
        module_register($module, $file);
        module_init($module);
    }
}

/**
 * Call all admin initiator functions for modules
 */
function modules_admin_init () {
    foreach (modules() as $module => $content) {
        function_exists($function = "{$module}_module_admin_init") and $function();
    }
}

/**
 * Register module
 * 
 * @param string $module
 */
function module_register ($module, $path) {
    function_exists($init = "{$module}_module_init") and $init();
    
    modules($module, array('path' => $path));
}

/**
 * Load module
 * 
 * @param string $module
 */
function module_load ($module) {
    if (!file_exists($module)) {
        throw new Exception("Module '$module' not found!");
    }
    
    require $module;
    
    return true;
}

/**
 * Call modules init and routes functions
 * 
 * @param string $module
 */
function module_init ($module) {
    $name = "{$module}_module_";
    $init = "{$name}init";
    
    function_exists($init) and $init();
}

/**
 * Get module's name from path
 * 
 * @param string $module_path
 */
function module_name ($module_path) {
    $directory = dirname($module_path);
    
    return substr($directory, strrpos($directory, '/') + 1);
}

/**
 * Get path to a module
 * 
 * @param string $module
 * @param string $file
 * @return string
 */
function module_path ($module, $file = '', $base = false) {
    $path = sprintf('modules/%s/%s', $module, $file);
    
    return $base ? $path : app_path($path);
}