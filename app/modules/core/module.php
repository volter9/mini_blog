<?php

/**
 * Core module
 * 
 * @package mini_blog
 */

function core_module_init () {
    $modules = ['posts', 'categories', 'users'];
    
    modules('core', []);
    
    foreach ($modules as $module) {
        module_register($module, "core/models/$module");
    }
}

function core_module_admin_init () {
    $default = lang('settings.default');
    $modules = ['posts', 'categories', 'users'];
    
    lang('admin', load_app_file("modules/core/i18n/$default"));
    
    foreach ($modules as $module) {
        module_menu($module, [
            'title'   => lang("admin.$module.title"),
            'url'     => url('#admin_view', [$module]),
            'submenu' => [
                [
                    'url'   => url('#admin_add', [$module]),
                    'title' => lang('admin.admin.add')
                ]
            ]
        ]);
    }
}