<?php

/**
 * Landing index page 
 */
function action_index () {
    load_model('landing', module_path('landing', 'models', true));
    
    layout(module_path('landing', 'views/index'), array(
        'title'    => 'Добро пожаловать!',
        'sections' => landing_sections()
    ));
}