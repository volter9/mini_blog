<?php

/**
 * Module system
 * 
 * @indev
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
function modules_load () {
    $modules = glob(MF_APP_DIR . 'modules/*/module.php');
    
    foreach ($modules as $module) {
        if (module_load($module)) {
            $name = module_name($module);
            
            module_init($name);
        }
    }
}

/**
 * Get module's name from path
 * 
 * @param string $module_path
 */
function module_name ($module_path) {
    $directory = dirname($module_path);
    
    // Forgot function's name, which is like 
    // strpos, but works on the last occurence
    $reversed = strrev($directory);
    $stripped = substr($reversed, 0, strpos($reversed, '/'));
    
    return strrev($stripped);
}

/**
 * Register module
 * 
 * @param string $module
 */
function module_register ($module, $path) {
    load_app_file("modules/$path");
    
    function_exists($init = "{$module}_module_init") and $init();
    
    modules($module, [
        'path' => $path
    ]);
}

/**
 * Load module
 * 
 * @param string $module
 */
function module_load ($module) {
    if ($found = file_exists($module)) {
        require $module;
    }
    
    return $found;
}

/**
 * Call modules init and routes functions
 * 
 * @param string $module
 */
function module_init ($module) {
    $name = "{$module}_module_";
    
    $init = "{$name}init";
    $routes = "{$name}routes";
    
    function_exists($init) and $init();
    function_exists($routes) and $routes();
}

/**
 * Add module to header admin menu
 * 
 * @param string $module
 * @param array $menu_info
 */
function module_menu ($module, array $menu_info) {
    if (!modules($module)) {
        return false;
    }
    
    modules("$module.menu", $menu_info);
}