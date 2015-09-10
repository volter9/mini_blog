<?php

/**
 * Initialize action
 */
function actions_init () {
    $path = module_path('blog', 'models', true);
    
    load_model('categories', $path);
    load_model('posts', $path);
}

/**
 * Index page
 * 
 * There's last few blog posts
 */
function action_index () {
    layout('posts/index', array(
        'title' => i18n('main'),
        'url'   => url('#posts'),
        'posts' => posts_all()
    ));
}