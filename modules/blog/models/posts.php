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
function posts_all ($page = 1, $pages = POSTS_PER_PAGE) {
    return paginate_query('
        SELECT
            p.id, p.title, p.url, p.text,
            p.category_id, p.date, 
            c.title as category, c.url as category_url
        FROM posts p
            LEFT JOIN categories c ON (p.category_id = c.id)
        ORDER BY p.id DESC, p.date DESC',
        array(), $pages, $page
    );
}

/**
 * Get posts by category id
 * 
 * @param int $id
 * @return array|bool
 */
function posts_by_category ($id, $page = 1, $pages = POSTS_PER_PAGE) {
    return paginate_query('
        SELECT 
            p.id, p.title, p.url, p.text,
            p.category_id, p.date, 
            c.title as category, c.url as category_url
        FROM posts p
            LEFT JOIN categories c ON (p.category_id = c.id)
        WHERE p.category_id = ?
        ORDER BY p.id DESC, p.date DESC',
        array($id), $pages, $page
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
            p.id, p.url, p.title, p.text,
            p.category_id, p.date, 
            c.title as category, c.url as category_url
        FROM posts p
            LEFT JOIN categories c ON (p.category_id = c.id)
        WHERE p.url = ?', 
        array($url), true
    );
}

/**
 * Generate the meta description field from text
 * 
 * @param string $text
 * @return string
 */
function post_description ($text) {
    $text = preg_replace('/(\n|\s|\t){2,}/', ' ', strip_tags($text));
    
    $dot  = mb_strpos($text, '.') + 1;
    $text = mb_substr($text, 0, mb_strpos($text, '.', $dot));
    $text = mb_substr($text, 0, 140);
    
    return chop($text, '.');
}