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
        'js' => array(module_url('blog', 'js/module.js')),
        'js_bootstrap' => 'blog_bootstrap'
    ));
}

/**
 * Add blog admin templates
 */
function blog_module_admin_init () {
    $user = users('user');
    
    admin('posts', array(
        'keys' => array(
            'title', 'url', 'text', 'date', 'user_id'
        ),
        'default' => array(
            'id'          => 0,
            'title'       => '',
            'text'        => '',
            'url'         => '',
            'date'        => date('Y-m-d H:i:s'),
            'user_id'     => array_get($user, 'id', 1),
            'username'    => array_get($user, 'username', 'admin')
        ),
        'filters' => array(
            'title'       => array('strip_tags', 'trim'),
            'text'        => array('trim')
        )
    ));
}

/**
 * @return string
 */
function blog_bootstrap () {    
    $js = '';
    
    if ($posts = views('data.posts')) {
        $posts = json($posts['items']);
        
        $js .= "mini_blog.posts.collection.bootstrap($posts);";
    }
    else if ($post = views('data.post')) {
        $post = json($post);
        
        $js .= "mini_blog.posts.collection.bootstrap([$post]);";
    }
    
    return $js;
}