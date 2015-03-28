<?php

/**
 * Get all categories
 * 
 * @return array|bool
 */
function categories_all () {
    return db_select('SELECT * FROM categories');
}

/**
 * Get a category by url
 * 
 * @param string $url
 * @return array|bool 
 */
function category_by_url ($url) {
    return db_select('
        SELECT * FROM categories 
        WHERE url = ?', 
        [$url], true
    );
}

/**
 * Categories form description
 * 
 * @return array
 */
function categories_describe () {
    return [
        'fields' => 'title, url, description',
        'per_page' => 8,
        'form' => [
            'title' => 'input',
            'url' => 'input',
            'description' => 'text',
        ]
    ];
}

/**
 * Categories form validation rules
 * 
 * @return array
 */
function categories_rules () {
    return [
        'title' => 'required|max_length:40',
        'url' => 'required|max_length:80|alpha_dash|unique:categories.url',
        'description' => 'required|max_length:500'
    ];
}