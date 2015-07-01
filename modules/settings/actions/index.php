<?php

/**
 * Save settings
 * 
 * @param string $group
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
    
    echo json_encode(array(
        'status' => settings_save($group, $input) ? 'ok' : 'not_ok'
    ));
}