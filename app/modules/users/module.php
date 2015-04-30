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
    load_model('users', module_path('users', 'models/site', true));
}

/**
 * Initialize admin section module
 */
function users_module_admin_init () {
    load_php(module_path('users', 'models/admin/users'));
    load_language('admin', module_path('users', 'i18n'));
    
    menu_add_item('users', 'admin.users.title', '#admin_view', array('users'));
}