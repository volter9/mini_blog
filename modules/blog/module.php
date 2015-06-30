<?php

/**
 * Blog module initialize
 */
function blog_module_init () {
    load_language('app', module_path('blog', 'i18n/site'));
}

/**
 * Blog module admin
 */
function blog_module_admin_init () {
    // admin();
}