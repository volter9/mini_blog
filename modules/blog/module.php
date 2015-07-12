<?php

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
    
    admin('posts', array(
        'keys' => array(
            'title', 'url', 'description', 'text', 'date', 'user_id'
        ),
        
        'default' => array(
            'id'          => 0,
            'title'       => 'Заголовок',
            'description' => 'Описание',
            'url'         => md5(microtime()),
            'date'        => date('Y-m-d H:i:s'),
            'user_id'     => array_get($user, 'id', 1),
            'username'    => array_get($user, 'username', 'admin')
        ),
        
        'filters' => array(
            'title'       => array('strip_tags', 'trim'),
            'description' => array('strip_tags', 'trim')
        )
    ));
}