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
    menu_add_subitem('landing', 'admin.landing.sections', '#admin_landing');
    menu_add_subitem('landing', 'admin.landing.templates', '#admin_landing');
    
    settings_add('landing', 'admin.landing.title', array(
        'title' => 'input'
    ));
    
    lang('admin.settings.landing', lang('admin.landing'));
}