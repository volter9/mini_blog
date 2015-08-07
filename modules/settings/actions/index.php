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
            'value' => strip_tags($value)
        );
        
        if (isset($settings[$key]) && $value === $settings[$key]) {
            unset($input[$key]);
        }
    }
    
    $result = settings_save($group, $input);
    
    echo json_encode(array(
        'status'  => $result ? 'ok' : 'not_ok',
        'message' => $result ? '' : "Setting by group '$group' isn't exists"
    ));
}

/**
 * Get settings
 * 
 * @param string $group
 */
function action_get ($id = 'default') {
    $settings = settings_get($id);
    
    echo json_encode(array(
        'status'   => !empty($settings) ? 'ok' : 'not_ok',
        'settings' => array_merge($settings, compact('id'))
    ));
}