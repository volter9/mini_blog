<?php

/**
 * Core module
 * 
 * @package mini_blog
 */

/**
 * Get core modules
 * 
 * @return array
 */
function core_modules () {
    return array('posts', 'categories', 'users');
}

/**
 * Initialize admin section module
 */
function core_module_admin_init () {
    $default = lang('settings.default');
    
    lang('admin', load_app_file("modules/core/i18n/$default"));
    
    foreach (core_modules() as $module) {
        load_php(module_path('core', "models/$module"));
        
        menu_add_item(
            $module, 
            lang("admin.$module.title"), 
            url('#admin_view', array($module))
        );
        
        menu_add_subitem(
            $module, 
            lang("admin.$module.add"), 
            url('#admin_add', array($module))
        );
    }
}