<?php

/**
 * Initialize action
 */
function actions_init () {
    load_model('posts');
}

/**
 * List all blog entries
 * 
 * @param int $page
 */
function action_list ($page = 1) {
    view('main', [
        'view'  => 'posts',
        'title' => 'Main page',
        'url'   => url('#posts'),
        'posts' => posts_all($page)
    ]);
}

/**
 * View a blog entry
 * 
 * @param string $url
 */
function action_view ($url = '') {
    if (!($post = post_by_url($url))) {
        return false;
    }
    
    view('main', [
        'view'  => 'post',
        'title' => $post['title'],
        'post'  => $post
    ]);
}