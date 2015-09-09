<?php

/**
 * Settings module initialize
 * 
 * Following function bootstraping some values from database into configs
 * and adding JS files for loading
 * 
 * @author volter9
 * @package mini_blog
 */
function settings_module_init () {
    load_model('settings', module_path('settings', 'models', true));
    load_language('app', module_path('settings', 'i18n'));
    
    if ($language = storage('settings.default.language')) {
        lang('settings.default', $language);
    }
    
    if ($template = storage('settings.default.template')) {
        views('templates.template', $template);
    }
    
    admin('settings', array(
        'js' => array(module_url('settings', 'js/module.js'))
    ));
    
    bind('blocks:head', function () {
        users('authorized') and view(module_path('settings', 'views/json'));
    });
}