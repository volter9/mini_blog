<?php

/**
 * Blog module initialize
 */
function blog_module_init () {
    load_language('app', module_path('blog', 'i18n/site'));
}

/**
 * Initialize admin section module
 */
function blog_module_admin_init () {
    load_language('admin', module_path('blog', 'i18n/admin'));
    
    load_php(module_path('blog', 'models/admin/posts'));
    load_php(module_path('blog', 'models/admin/categories'));
    
    menu_add_item('blog', "admin.blog.title", '#admin_view', array('posts'));
    
    menu_add_subitem('blog', "admin.posts.title", '#admin_view', array('posts'));
    menu_add_subitem('blog', "admin.posts.add", '#admin_add', array('posts'));
    menu_add_subitem('blog', "admin.categories.title", '#admin_view', array('categories'));
    
    admin_add_module('posts', array(
        'rules'       => 'posts_module_rules',
        'description' => 'posts_module_describe'
    ));
    
    admin_add_module('categories', array(
        'rules'       => 'categories_module_rules',
        'description' => 'categories_module_describe'
    ));
    
    bind('admin:posts.filter', 'posts_module_filter');
    
    bind('admin:head', function () {
        printf(
            '<link href="%s" rel="stylesheet" type="text/css"/>', 
            module_url('blog', 'views/posts.css')
        );
    });
}