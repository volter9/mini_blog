<?php

/**
 * Categories form description
 * 
 * @return array
 */
function categories_module_describe () {
    return array(
        'fields'   => 'title, description',
        'per_page' => 10,
        
        'form' => array(
            'title'       => 'input',
            'url'         => 'input',
            'description' => 'input'
        )
    );
}

/**
 * Categories validation rules
 * 
 * @return array
 */
function categories_module_rules () {
    return array(
        'title' => 'required|max_length:40|no_html',
        'url'   => 'required|alpha_dash|max_length:40'
    );
}
