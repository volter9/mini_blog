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
    $path = module_path('users', 'models', true);
    
    load_model('users' , $path);
    load_model('groups', $path);
    
    groups('*', 'admin.groups.permissions.all');
    
    bind('router:found', function ($route, $matches) {
        $id = after($route['id'], '#');
        
        if (!empty($matches)) {
            $id .= ':' . implode(',', $matches);
        }
        
        if (
            starts_with($id, 'admin_') && 
            !is_allowed("route_$id") &&
            $id !== 'admin_denied'
        ) {
            require module_path('users', 'actions/denied.php');
            
            action_index();
            
            exit;
        }
    });
}

/**
 * Initialize admin section module
 */
function users_module_admin_init () {
    load_language('admin', module_path('users', 'i18n'));
    
    load_php(module_path('users', 'models/admin/groups'));
    
    menu_add_item('users', 'admin.users.title', '#admin_view', array('users'));
    menu_add_subitem('users', 'admin.groups.title', '#admin_view', array('groups'));
    
    admin_add_module('users', array(
        'rules'       => 'users_module_rules',
        'description' => 'users_module_describe',
    ));
    
    admin_add_module('groups', array(
        'rules'       => 'groups_module_rules',
        'description' => 'groups_module_describe',
    ));
    
    $callback = function () {
        forms('providers', load_php(module_path('users', 'providers')));
    };
    
    bind('admin:users.filter', 'users_module_filter');
    
    bind('admin:groups.add', $callback);
    bind('admin:groups.edit', $callback);
    bind('admin:groups.filter', 'groups_module_filter');
    
    bind('admin:head', function () {
        printf(
            '<link href="%s" rel="stylesheet" type="text/css"/>', 
            module_url('users', 'views/groups/styles.css')
        );
    });
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
    $password = strlen($password) !== 32 ? md5($password) : null;
    
    if ($password) {
        array_set($data, 'password', $password);
    }
    
    return $data;
}