<?php

/**
 * Initialize action
 */
function actions_init () {
    load_model('categories');
    load_model('posts');
}

/**
 * View a category by url slug and its posts
 * 
 * @param string $url
 */
function action_view ($url, $page = 1) {
    if (!$category = category_by_url($url)) {
        return false;
    }
    
    view('main', array(
        'view'  => 'posts/index',
        'title' => $category['title'],
        'posts' => posts_by_category($category['id'], $page),
        'url'   => url('#category', array($category['url']))
    ));
}