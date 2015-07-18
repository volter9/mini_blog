<?php

/**
 * Module system
 * 
 * @package mini_blog
 */

/**
 * Modules storage
 * 
 * @param mixed $key
 * @param mixed $value
 * @return mixed
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
 *
 * @param array $modules
 */
function modules_load (array $modules) {
    foreach ($modules as $key => $module) {
        $file = base_path("modules/$module/module");
        
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
 * Register module
 * 
 * @param string $module
 * @param string $path
 */
function module_register ($module, $path) {
    modules($module, compact('path'));
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
 * Initiate admin callbacks
 */
function module_admin_init () {
    foreach (modules() as $name => $_) {
        $function = "{$name}_module_admin_init";
        
        function_exists($function) and $function();
    }
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
 * Load module providers, if they're exists
 * 
 * @return array
 */
function modules_providers () {
    $providers = array();
    
    foreach (modules() as $name => $_) {
        $file = module_path($name, 'providers.php');
    
        if (file_exists($file)) {
            $providers = array_merge($providers, require $file);
        }
    }
    
    return $providers;
}

/**
 * Get path to a module
 * 
 * @param string $module
 * @param string $file
 * @param bool $base
 * @return string
 */
function module_path ($module, $file = '', $base = false) {
    $path = sprintf('modules/%s/%s', $module, $file);
    
    return $base ? $path : base_path($path);
}

/**
 * Get url to module asset
 * 
 * @param string $module
 * @param string $file
 * @return string
 */
function module_url ($module, $file = '') {
    $path = sprintf('modules/%s/%s', $module, $file);
    
    return path($path);
}