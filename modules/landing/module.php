<?php

/**
 * Landing page module
 * 
 * @author volter9
 */

/**
 * Landing module amin initialize
 */
function landing_module_admin_init () {
    load_language('admin', module_path('landing', 'i18n'));
    
    menu_add_item('landing', 'admin.landing.title', '#admin_landing');
}