<?php

/**
 * Landing index page 
 */
function action_index () {
    load_model('landing', module_path('landing', 'models', true));
    
    $settings = settings_get('landing');
    
    module_layout('landing', 'landing', array(
        'title'    => array_get($settings, 'title', 'Добро пожаловать!'),
        'sections' => landing_sections()
    ), true);
}