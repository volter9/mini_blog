<?php

/**
 * Check if settings group exists
 * 
 * @return bool
 */
function actions_init () {
    $group = router('route.matches.0');
    
    if ($group !== '' && !settings($group)) {
        return false;
    }
    
    load_api('forms');
}

/**
 * Index action
 */
function action_index ($group = 'default') {
    settings_view($group, settings_get($group));
}

/**
 * Save settings
 */
function action_save ($group = 'default') {
    $input = input();
    $settings = settings_get($group);
    
    foreach ($input as $key => $value) {
        $input[$key] = array(
            'exist' => isset($settings[$key]),
            'value' => $value
        );
        
        if (isset($settings[$key]) && $value === $settings[$key]) {
            unset($input[$key]);
        }
    }
    
    if (settings_save($group, $input)) {
        redirect('#admin_settings', array($group));
    }
}

/**
 * View settings page
 * 
 * @param string $group
 * @param array $input
 * @param array $errors
 */
function settings_view ($group, array $input = array(), array $errors = array()) {
    forms('providers', load_php(module_path('settings', 'providers')));
    
    layout(module_path('settings', 'views/index'), array(
        'title'     => lang('admin.settings.title'),
        'subheader' => lang("admin.settings.$group.title"),
        
        'scheme' => array(
            'view'   => 'forms/basic',
            'submit' => lang('admin.common.save'),
            'action' => url('#admin_settings_post', array($group)),
            'form'   => settings($group)
        ),
        
        'data' => array(
            'errors'   => $errors,
            'input'    => $input,
            'field'    => lang("admin.settings.$group.fields"),
            'tooltips' => lang("admin.settings.$group.tooltips")
        )
    ));
}