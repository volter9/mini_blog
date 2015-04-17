<?php

/**
 * Admin module init
 */
function admin_module_init () {
    load_php(module_path('admin', 'routes'));
}

/**
 * Load admin modules
 */
function admin_module_admin_init () {
    load_component('admin');
    load_component('menu');
}