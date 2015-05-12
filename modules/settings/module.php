<?php

/**
 * Settings module initialize
 */
function settings_module_init () {
    load_model('settings', module_path('settings', 'models', true));
    
    if ($language = storage('settings.default.language')) {
        lang('settings.default', $language);
    }
    
    if ($template = storage('settings.default.template')) {
        views('templates.template', $template);
    }
}

/**
 * Settings module initialize in admin section
 */
function settings_module_admin_init () {
    load_language('admin', module_path('settings', 'i18n'));
    
    menu_add_item('settings', 'admin.settings.title', '#admin_settings');
}