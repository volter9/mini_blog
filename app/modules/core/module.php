<?php

/**
 * Core module
 * 
 * @package mini_blog
 */

function core_module_init () {
    $modules = array('posts', 'categories', 'users');
    
    modules('core', array());
    
    foreach ($modules as $module) {
        module_register($module, "core/models/$module");
    }
}

function core_module_admin_init () {
    $default = lang('settings.default');
    $modules = array('posts', 'categories', 'users');
    
    lang('admin', load_app_file("modules/core/i18n/$default"));
    
    foreach ($modules as $module) {
        module_menu($module, array(
            'title' => lang("admin.$module.title"),
            'url'   => url('#admin_view', array($module)),
            'submenu' => array(array(
                'url'   => url('#admin_add', array($module)),
                'title' => lang("admin.$module.add")
            ))
        ));
    }
}