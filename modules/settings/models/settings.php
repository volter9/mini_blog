<?php

/**
 * Settings
 * 
 * @param mixed $key
 * @param mixed $value
 * @return mixed
 */
function settings ($key = null, $value = null) {
    static $repo = null;
    
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Initalize settings
 */
function settings_init () {
    storage('settings.default', settings_get('default'));
}

/**
 * Add setting set to 
 * 
 * @param string $group
 * @param string $label
 * @param array $form
 */
function settings_add ($group, $label, array $form) {
    settings($group, $form);
}

/**
 * Get settings by group
 * 
 * @param string $group
 * @return array|bool
 */
function settings_get ($group) {
    if ($settings = storage("settings.$group")) {
        return $settings;
    }
    
    $settings = db_select('
        SELECT id, name, `value`
        FROM settings
        WHERE `group` = ?', 
        array($group)
    );
    
    if ($settings) {
        return array_join($settings, 'name', 'value');
    }
    
    return array();
}

/**
 * Save settings
 * 
 * @param string $group
 * @param array $data
 * @return bool|int
 */
function settings_save ($group, array $data) {
    $result = true;
    
    foreach ($data as $key => $array) {
        $result = $result && setting_save($group, $key, $array['value'], $array['exist']);
    }
    
    return $result;
}

/**
 * Save a setting into database
 * 
 * @param string $group
 * @param string $name
 * @param string $value
 * @param bool $exists
 */
function setting_save ($group, $name, $value, $exists) {
    if ($exists) {
        $criteria = array(
            'group[=]' => $group,
            'name[=]'  => $name
        );
        
        return db_update('settings', compact('value'), $criteria);
    }
    else {
        return db_insert('settings', compact('group', 'name', 'value'));
    }
}