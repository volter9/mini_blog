<?php

/**
 * Admin routes
 * 
 * @package mini_blog
 */

/**
 * Index and auth
 */
route('GET #admin_index /admin', 'app/admin/actions/index');
route('GET #auth_admin /admin/auth', 'app/admin/actions/index:auth');
route('POST #auth_login /admin/login', 'app/admin/actions/index:login');
route('GET #auth_signout /admin/auth/signout', 'app/admin/actions/index:signout');

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
    'GET #admin_view /admin/:any/:num?', 
    'app/admin/actions/module:view'
);

route(
    'GET #admin_add /admin/:any/add', 
    'app/admin/actions/module:add'
);
route(
    'POST #admin_add_post /admin/:any/add', 
    'app/admin/actions/module:add_post'
);

route(
    'GET #admin_edit /admin/:any/edit/:num', 
    'app/admin/actions/module:edit'
);
route(
    'POST #admin_edit_post /admin/:any/edit/:num', 
    'app/admin/actions/module:edit_post'
);

route(
    'GET #admin_remove /admin/:any/remove/:num', 
    'app/admin/actions/module:remove'
);

/**
 * Check for unauthorized users and set admin template
 */
bind('router:found', function ($route) {
    if (strpos($route['id'], '#admin_') !== false && !users('authorized')) {
        redirect('#auth_admin');
    }
    
    if (strpos($route['id'], '#admin_') !== false || strpos($route['id'], '#auth_') !== false) {
        $default = lang('settings.default');
        load_language('admin', "app/admin/i18n/$default");
        
        views('templates.template', 'admin');
    }
});