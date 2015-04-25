<?php

/**
 * Settings module initialize
 */
function settings_module_init () {
    load_model('settings', module_path('settings', 'models', true));
    
    lang('settings.default', storage('settings.default.language'));
    views('templates.template', storage('settings.default.template'));
}

/**
 * Settings module initialize in admin section
 */
function settings_module_admin_init () {
    load_language('admin', module_path('settings', 'i18n'));
    
    menu_add_item('settings', lang('admin.settings.title'), url('#admin_settings'));
}