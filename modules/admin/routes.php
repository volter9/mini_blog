<?php

/**
 * Admin routes
 * 
 * - Add an item from database
 * - Edit an item from database
 * - Remove an item from database
 */

$path = module_path('admin', 'actions');

route('POST #admin_get /admin/:any/get/:num', "$path/module:get");
route('POST #admin_add /admin/:any/add', "$path/module:add");
route('POST #admin_edit /admin/:any/edit/:num', "$path/module:edit");
route('POST #admin_remove /admin/:any/remove/:num', "$path/module:remove");

bind('router:found', function ($route) {
    $id = $route['id'];
    
    if (starts_with($id, '#admin_')) {
        module_admin_init();
    }
});