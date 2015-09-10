<?php

/**
 * Admin routes
 * 
 * - CRUD 
 * - Templates
 * - Providers
 */

$path = module_path('api', 'actions');

route('GET #api_get /api/:any/get/:num', "$path/module:get");
route('POST #api_add /api/:any/add', "$path/module:add");
route('POST #api_edit /api/:any/edit/:num', "$path/module:edit");
route('POST #api_remove /api/:any/remove/:num', "$path/module:remove");

route('GET #api_provider /api/provider/:any/', "$path/module:provider");
route('POST #api_template /api/template/:any/', "$path/module:template");

bind('router:found', function ($route) {
    if (starts_with($route['id'], '#api_')) {
        module_admin_init();
    }
});