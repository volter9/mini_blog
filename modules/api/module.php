<?php

/**
 * Admin module
 * 
 * This module is responsible for managing all content
 * via AJAX
 * 
 * @author volter9
 * @package mini_blog
 */

function api_module_init () {
    $path = module_url('api');
    
    admin('api', array(
        'js' => array("{$path}js/main.js")
    ));
    
    bind('blocks:head', function () {
        users('authorized') and view(module_path('api', 'views/head'));
    });
    
    bind('blocks:header', function () {
        users('authorized') and view(module_path('api', 'views/panel'));
    });
    
    bind('blocks:footer', function () {
        users('authorized') and view(module_path('api', 'views/footer'));
    });
}