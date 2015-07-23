<?php

/**
 * Admin module
 * 
 * This module is responsible for managing all content
 * via AJAX
 */

function admin_module_init () {
    $path = module_url('admin');
    
    admin('admin', array(
        'js' => array(
            "{$path}js/mini_blog.js",
            "{$path}js/framework.js",
            "{$path}js/mods.js"
        )
    ));
    
    bind('blocks:header', function () {
        users('authorized') and view(module_path('admin', 'panel'));
    });
    
    bind('blocks:footer', function () {
        users('authorized') and view(module_path('admin', 'footer'));
    });
}