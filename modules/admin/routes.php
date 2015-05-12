<?php

/**
 * Admin routes
 * 
 * @package mini_blog
 */

$path = module_path('admin', 'actions');

/**
 * Index and login form page
 */
route('GET #admin_index /admin', "$path/index");
route('GET #auth_admin /admin/auth', "$path/index:auth");
route('POST #auth_login /admin/login', "$path/index:login");
route('GET #auth_signout /admin/auth/signout', "$path/index:signout");

/**
 * Routes to admin sections.
 * 
 * Each section has at least four actions:
 * - View all items with pagination
 * - Add an item
 * - Edit an item
 * - Remove an item
 */
route(
    'GET #admin_view /admin/:any/view/:num?', 
    "$path/module:view"
);

route(
    'GET #admin_add /admin/:any/add', 
    "$path/module:add"
);
route(
    'POST #admin_add_post /admin/:any/add', 
    "$path/module:add_post"
);

route(
    'GET #admin_edit /admin/:any/edit/:num', 
    "$path/module:edit"
);
route(
    'POST #admin_edit_post /admin/:any/edit/:num', 
    "$path/module:edit_post"
);

route(
    'GET #admin_remove /admin/:any/remove/:num', 
    "$path/module:remove"
);

/**
 * Check for unauthorized users and set admin template
 */
bind('router:found', function ($route) {
    $id = $route['id'];
    
    if (starts_with($id, '#admin_') && !users('authorized')) {
        redirect('#auth_admin');
    }
    
    if (starts_with($id, '#admin_') || starts_with($id, '#auth_')) {
        load_language('admin', module_path('admin', 'i18n'));
        
        views('templates.template', 'admin');
        modules_admin_init();
    }
});