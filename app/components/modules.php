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
        module_routes($module);
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
    modules($module, array('path' => $path));
}

/**
 * Call modules init and routes functions
 * 
 * @param string $module
 */
function module_init ($module) {
    function_exists($init = "{$module}_module_init") and $init();
}

/**
 * Load module routes, if they're exists
 * 
 * @param string $module
 */
function module_routes ($module) {
    $file = module_path($module, 'routes.php');
    
    file_exists($file) and require $file;
}

/**
 * Get module's name from path
 * 
 * @param string $module_path
 */
function module_name ($module_path) {
    $directory = dirname($module_path);
    
    return after($directory, '/');
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