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
            "{$path}js/panel.js",
            "{$path}js/mods.js"
        )
    ));
}