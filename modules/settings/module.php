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
    
    if ($language = storage('settings.default.language')) {
        lang('settings.default', $language);
    }
    
    if ($template = storage('settings.default.template')) {
        views('templates.template', $template);
    }
    
    admin('settings', array(
        'js' => array(module_url('settings', 'js/module.js')),
        'js_bootstrap' => function () {
            $settings = json(storage('settings'));
            
            return "mini_blog.settings.collection.bootstrap($settings);";
        }
    ));
}