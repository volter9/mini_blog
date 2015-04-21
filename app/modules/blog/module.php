<?php

/**
 * Blog routes.
 * Here are routes to:
 * 
 * Index page
 * Blog posts
 * Blog categories
 */
function blog_module_init () {
    $path = module_path('blog');
    
    load_language('app', module_path('blog', 'i18n/site'));
    
    route('GET #index /', "{$path}actions/index");
    route('GET #posts /blog/all/:num?', "{$path}actions/blog:list");
    route('GET #post /blog/:any', "{$path}actions/blog:view");
    route('GET #category /categories/:any/:num?', "{$path}actions/categories:view");
}

/**
 * Initialize admin section module
 */
function blog_module_admin_init () {
    load_language('admin', module_path('blog', 'i18n/admin'));
    
    foreach (array('posts', 'categories') as $module) {
        load_php(module_path('blog', "models/admin/$module"));
        
        menu_add_item(
            $module, 
            lang("admin.$module.title"), 
            url('#admin_view', array($module))
        );

        
        menu_add_subitem(
            $module, 
            lang("admin.$module.add"), 
            url('#admin_add', array($module))
        );
    }
}