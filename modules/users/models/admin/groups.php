<?php

/**
 * Groups form description
 * 
 * @return array
 */
function groups_module_describe () {
    return array(
        'fields'   => 'name, privileges',
        'per_page' => 10,
        
        'form' => array(
            'name'       => 'input',
            'privileges' => 'input'
        )
    );
}

/**
 * Groups form validation rules
 * 
 * @return array
 */
function groups_module_rules () {
    return array(
        'name'       => 'required|max_length:20|min_length:6|alpha_dash',
        'privileges' => 'required',
    );
}