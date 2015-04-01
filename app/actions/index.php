<?php

/**
 * Initialize action
 */
function actions_init () {
    load_model('categories');
    load_model('posts');
}

/**
 * Index page
 * 
 * There's last few blog posts
 */
function action_index () {
    view('main', [
        'view'  => 'posts/index',
        'title' => i18n('main'),
        'url'   => url('#posts'),
        'posts' => posts_all()
    ]);
}