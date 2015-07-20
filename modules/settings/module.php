<?php

/**
 * Settings module initialize
 * 
 * Following function bootstraping some values from database into configs
 * and adding JS files for loading
 */
function settings_module_init () {
    load_model('settings', module_path('settings', 'models', true));
    
    if ($language = storage('settings.default.language')) {
        lang('settings.default', $language);
    }
    
    if ($template = storage('settings.default.template')) {
        views('templates.template', $template);
    }
    
    admin('settings', array(
        'js' => array(module_url('settings', 'js/module.js'))
    ));
}