<?php

/**
 * Load templates model
 */
function actions_init () {
    load_php(module_path('templates', 'models/templates'));
    
    bind('admin:head', function () {
        printf(
            '<link href="%s" rel="stylesheet" type="text/css"/>', 
            module_url('templates', 'views/templates.css')
        );
    });
}

/**
 * View all templates
 */
function action_index () {
    $title = lang('admin.templates.title');
    $templates = array();
    
    foreach (templates() as $template) {
        $templates[$template] = template_manifest($template);
    }
    
    layout(module_path('templates', 'views/index'), array(
        'title'  => $title,
        'header' => $title,
        'data'   => $templates,
    ));
}

/**
 * Choose the template
 * 
 * @param string $template
 */
function action_choose ($template) {
    $default = settings_get('default');
    $exists  = array_get($default, 'template') !== false;
    
    if (setting_save('default', 'template', $template, $exists)) { 
        redirect('#admin_templates_view');
    }
    
    action_index();
}