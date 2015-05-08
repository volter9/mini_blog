<?php

/**
 * Landing index page 
 */
function action_index () {
    load_model('landing', module_path('landing', 'models', true));
    
    layout('index', array(
        'title'    => 'Добро пожаловать!',
        'sections' => landing_sections()
    ));
}