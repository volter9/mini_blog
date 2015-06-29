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

/**
 * View module view
 * 
 * @param string $module
 * @param string $view
 * @param array $data
 * @param bool $as_fallback
 */
function module_layout ($module, $view, array $data = array(), $as_fallback = false) {
    $view_path = module_path($module, "views/$view");
    
    if ($as_fallback) {
        $theme_view_path = view_path($view);
        
        if (ends_with($theme_view_path, '.php')) {
            $theme_view_path = substr($theme_view_path, 0, -4);
        }
        
        if (file_exists($theme_view_path . '.php')) {
            return layout($theme_view_path, $data);
        }
    }
    
    layout($view_path, $data);
}