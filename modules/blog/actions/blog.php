<?php

/**
 * Initialize action
 */
function actions_init () {
    load_model('posts', module_path('blog', 'models', true));
}

/**
 * List all blog entries
 * 
 * @param int $page
 */
function action_list ($page = 1) {
    layout('posts/index', array(
        'title' => i18n('main'),
        'url'   => url('#posts'),
        'posts' => posts_all($page)
    ));
}

/**
 * View a blog entry
 * 
 * @param string $url
 */
function action_view ($url = '') {
    if (!$post = post_by_url($url)) {
        return false;
    }
    
    layout('posts/post', array(
        'title' => $post['title'],
        'post'  => $post,
        
        'description' => $post['description']
    ));
}