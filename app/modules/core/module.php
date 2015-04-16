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
 * Core module initialize
 */
function core_module_init () {
    modules('core', array());
    
    foreach (core_modules() as $module) {
        module_register($module, "core/models/$module");
    }
}

/**
 * Initialize admin section module
 * 
 * 
 */
function core_module_admin_init () {
    $default = lang('settings.default');
    
    lang('admin', load_app_file("modules/core/i18n/$default"));
    
    foreach (core_modules() as $module) {
        module_menu($module, array(
            'title' => lang("admin.$module.title"),
            'url'   => url('#admin_view', array($module)),
            'submenu' => array(
                array(
                    'title' => lang("admin.$module.add"),
                    'url'   => url('#admin_add', array($module))
                )
            )
        ));
    }
}