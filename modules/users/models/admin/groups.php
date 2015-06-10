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
        
        'templates' => array(
            'view' => module_path('users', 'views/groups/view')
        ),
        
        'form' => array(
            'name' => 'input',
            'privileges' => module_path('users', 'views/checkboxes') . ':privileges'
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

/**
 * Filter group data
 * 
 * @param array $data
 * @return $data
 */
function groups_module_filter ($data) {
    $privileges = $data['privileges'];
    
    $data['privileges'] = in_array('*', $privileges) ? '*' : implode(',', $privileges);
    
    return $data;
}