<?php

/**
 * Admin module
 * 
 * This module is responsible for managing all content
 * via AJAX
 */

function admin_module_init () {
    admin('admin', array(
        'js' => array(module_url('admin', 'js/mods.js'))
    ));
}