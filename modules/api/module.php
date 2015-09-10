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

/**
 * Alias for json_encode
 */
function json (array $data) {
    return json_encode($data, JSON_UNESCAPED_UNICODE);
}

function api_module_init () {
    $path = module_url('api');
    
    admin('api', array(
        'js'  => array("{$path}js/main.js"),
        'css' => array(
            module_url('api', 'css/mini_blog.css'),
            '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'
        )
    ));
    
    bind('blocks:head', function () {
        is_admin() and view(module_path('api', 'views/head'));
    });
    
    bind('blocks:header', function () {
        is_admin() and view(module_path('api', 'views/header'));
    });
    
    bind('blocks:footer', function () {
        is_admin() and view(module_path('api', 'views/footer'));
    });
}