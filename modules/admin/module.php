<?php

/**
 * Load admin modules
 */
function admin_module_admin_init () {
    load_component('admin');
    
    groups('route_admin_index', 'admin.common.welcome.title');
}