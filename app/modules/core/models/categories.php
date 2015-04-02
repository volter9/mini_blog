<?php

/**
 * Initialize categories
 */
function categories_module_init () {
    
}

/**
 * Categories form description
 * 
 * @return array
 */
function categories_module_describe () {
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
function categories_module_rules () {
    return [
        'title' => 'required|max_length:40',
        'url' => 'required|max_length:80|alpha_dash|unique:categories.url',
        'description' => 'required|max_length:500'
    ];
}