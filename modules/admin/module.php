<?php

/**
 * Admin module
 * 
 * This module is responsible for managing all content
 * via AJAX
 */

function admin_module_admin_init () {
    load_php(module_path('admin', 'models/templates'));
}