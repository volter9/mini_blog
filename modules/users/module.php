<?php

/**
 * Users module
 * 
 * @package mini_blog
 */

/**
 * Users module initialize
 */
function users_module_init () {
    load_model('users', module_path('users', 'models', true));
}

/**
 * Initialize admin section module
 */
function users_module_admin_init () {
    load_language('admin', module_path('users', 'i18n'));
    
    menu_add_item('users', 'admin.users.title', '#admin_view', array('users'));
    menu_add_subitem('users', 'admin.users.add', '#admin_add', array('users'));
    
    admin_add_module('users', array(
        'rules'       => 'users_module_rules',
        'description' => 'users_module_describe',
    ));
    
    bind('admin:users.filter', 'users_module_filter');
}

/**
 * Users form description
 * 
 * @return array
 */
function users_module_describe () {
    return array(
        'fields'   => 'username, mail',
        'per_page' => 10,
        
        'form' => array(
            'username' => 'input',
            'password' => 'password',
            'mail'     => 'input',
            'group_id' => 'select:groups',
        )
    );
}

/**
 * Users form validation rules
 * 
 * @return array
 */
function users_module_rules () {
    return array(
        'username' => 'required|max_length:20|min_length:6|alpha_dash|unique:users.username',
        'password' => 'required|min_length:6|alpha_dash',
        'mail'     => 'required|valid_mail|max_length:40|unique:users.mail',
        'group_id' => 'required|is_numeric'
    );
}

/**
 * Filter user module
 * 
 * @param array $data
 * @return array $data
 */
function users_module_filter (array $data) {
    $password = array_get($data, 'password');
    $password = $password ? md5($password) : null;
    
    if ($password) {
        array_set($data, 'password', $password);
    }
    
    return $data;
}