<?php

/**
 * mini_blog blog module
 * 
 * This module provides few controllers for viewing and listing posts. 
 * 
 * @author volter9
 * @package mini_blog
 */

/**
 * Blog module initialize
 */
function blog_module_init () {
    load_language('app', module_path('blog', 'i18n/site'));
    
    admin('posts', array(
        'js' => array(module_url('blog', 'js/module.js'))
    ));
}

/**
 * Add blog admin templates
 */
function blog_module_admin_init () {
    $user = users('user');
    
    $strip = function ($value) { return strip_tags($value); };
    $trim  = function ($value) { return trim($value); };
    
    admin('posts', array(
        'keys' => array(
            'title', 'url', 'text', 'date'
        ),
        'default' => array(
            'title' => '',
            'text'  => '',
            'date'  => date('Y-m-d H:i:s'),
            'url'   => '',
            'id'    => 0
        ),
        'filters' => array(
            'title' => array($strip, $trim),
            'text'  => array($trim)
        )
    ));
}