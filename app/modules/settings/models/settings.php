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
    settings('default', array(
        'sitename' => 'input',
        'language' => 'select:langauges'
    ));
    
    storage('settings.default', settings_get('default'));
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
        $settings = array_join($settings, 'name', 'value');
        
        settings("all_settings.$group", $settings);
        
        return $settings;
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
    $value = compact('group', 'name', 'value');
    
    if ($exists) {
        unset($value['name'], $value['group']);
        
        $criteria = array(
            'group[=]' => $group,
            'name[=]'  => $name
        );
        
        return db_update('settings', $value, $criteria);
    }
    else {
        return db_insert('settings', $value);
    }
}