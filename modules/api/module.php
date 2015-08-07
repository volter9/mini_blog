<?php

/**
 * Admin module
 * 
 * This module is responsible for managing all content
 * via AJAX
 */

function api_module_init () {
    $path = module_url('api');
    
    admin('api', array(
        'js' => array(
            "{$path}js/main.js",
            "{$path}js/mods.js"
        )
    ));
    
    bind('blocks:header', function () {
        users('authorized') and view(module_path('api', 'views/panel'));
    });
    
    bind('blocks:footer', function () {
        users('authorized') and view(module_path('api', 'views/footer'));
    });
}