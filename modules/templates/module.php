<?php

/**
 * Templates module
 * 
 * Following module will allow you to choose templates and 
 * view their information
 * 
 * @package mini_blog
 */

/**
 * Set current template
 */
function templates_module_init () {
    if ($template = storage('settings.default.template')) {
        views('templates.template', $template);
    }
}

/**
 * Add templates item menu
 */
function templates_module_admin_init () {
    load_language('admin', module_path('templates', 'i18n'));
    
    menu_add_item('templates', 'admin.templates.title', '#admin_templates_view');
}