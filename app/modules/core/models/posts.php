<?php

/**
 * Posts form description
 * 
 * @return array
 */
function posts_module_describe () {
    return array(
        'fields' => 'title, url, description',
        'per_page' => 5,
        'form' => array(
            'title' => 'input',
            'url' => 'input',
            'description' => 'text',
            'text' => 'markdown',
            'user_id' => 'select:users',
            'category_id' => 'select:categories'
        )
    );
}

/**
 * Users form validation rules
 * 
 * @return array
 */
function posts_module_rules () {
    return array(
        'title' => 'required|max_length:40|no_html',
        'url' => 'required|alpha_dash|max_length:80|unique:posts.url',
        'description' => 'required|max_length:500|html',
        'text' => 'required|html',
        'user_id' => 'required|is_numeric',
        'category_id' => 'required|is_numeric'
    );
}