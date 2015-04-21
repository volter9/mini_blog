<?php

/**
 * Settings module initialize
 */
function settings_module_init () {
    $path = module_path('settings', 'actions');
    
    load_model('settings', module_path('settings', 'models', true));
    
    lang('settings.default', setting('default.language'));
    views('templates.template', setting('default.template'));
    
    route('GET #admin_settings /admin/settings/:any?', "$path/index");
    route('POST #admin_settings_post /admin/settings/:any?', "$path/index:save");
}

/**
 * Settings module initialize in admin section
 */
function settings_module_admin_init () {
    load_language('admin', module_path('settings', 'i18n'));
    
    menu_add_item('settings', lang('admin.settings.title'), url('#admin_settings'));
}