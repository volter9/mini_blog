<?php

/**
 * @const int POSTS_PER_PAGE The name is self-explanatory
 */
define('POSTS_PER_PAGE', 5);

/**
 * Initiate Posts model
 */
function posts_init () {
    load_api('pagination');
}

/**
 * Get all posts
 * 
 * @return array|bool
 */
function posts_all ($page = 1) {
    return paginate_query('
        SELECT
            p.title, p.url, p.description, 
            p.user_id, p.category_id, p.date, 
            u.username, 
            c.title as category, c.url as category_url
        FROM posts p
            LEFT JOIN users u ON (p.user_id = u.id)
            LEFT JOIN categories c ON (p.category_id = c.id)
        ORDER BY p.date DESC',
        [], POSTS_PER_PAGE, $page
    );
}

/**
 * Get posts by category id
 * 
 * @param int $id
 * @return array|bool
 */
function posts_by_category ($id, $page = 1) {
    return paginate_query('
        SELECT 
            p.title, p.url, p.description, 
            p.user_id, p.category_id, p.date, 
            u.username, 
            c.title as category, c.url as category_url
        FROM posts p
            LEFT JOIN users u ON (p.user_id = u.id)
            LEFT JOIN categories c ON (p.category_id = c.id)
        WHERE p.category_id = ?
        ORDER BY p.date DESC',
        [$id], POSTS_PER_PAGE, $page
    );
}

/**
 * Get posts by url
 * 
 * @param string $url
 * @return array|bool
 */
function post_by_url ($url) {
    return db_select('
        SELECT
            p.title, p.url, p.text, p.description, 
            p.user_id, p.category_id, p.date, 
            u.username, 
            c.title as category, c.url as category_url
        FROM posts p
            LEFT JOIN users u ON (p.user_id = u.id)
            LEFT JOIN categories c ON (p.category_id = c.id)
        WHERE p.url = ?
        ORDER BY p.date DESC', 
        [$url], 
        true
    );
}

/**
 * Posts form description
 * 
 * @return array
 */
function posts_describe () {
    return [
        'fields' => 'title, url, description',
        'per_page' => 5,
        'form' => [
            'title' => 'input',
            'url' => 'input',
            'description' => 'text',
            'text' => 'markdown',
            'user_id' => 'select:users',
            'category_id' => 'select:categories'
        ]
    ];
}

/**
 * Users form validation rules
 * 
 * @return array
 */
function posts_rules () {
    return [
        'title' => 'required|max_length:40',
        'url' => 'required|alpha_dash|max_length:80|unique:posts.url',
        'description' => 'required|max_length:500',
        'text' => 'required',
        'user_id' => 'required|is_numeric',
        'category_id' => 'required|is_numeric'
    ];
}