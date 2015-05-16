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
    
    menu_add_item('posts', "admin.blog.title", '#admin_view', array('posts'));
    menu_add_subitem('posts', "admin.posts.title", '#admin_view', array('posts'));
    menu_add_subitem('posts', "admin.posts.add", '#admin_add', array('posts'));
    
    bind('admin:posts.filter', 'posts_module_filter');
    
    bind('admin:head', function () {
        printf(
            '<link href="%s" rel="stylesheet" type="text/css"/>', 
            module_url('blog', 'views/posts.css')
        );
    });
}