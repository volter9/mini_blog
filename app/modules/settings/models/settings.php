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
        'template' => 'select:templates',
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
        $value = array(
            'group' => $group,
            'name'  => $key,
            'value' => $array['value']
        );
        
        if ($array['exist']) {
            unset($value['name'], $value['group']);
            
            $criteria = array(
                'name[=]'  => $key,
                'group[=]' => $group
            );
            
            $result = $result && db_update('settings', $value, $criteria);
        }
        else {
            $result = $result && db_insert('settings', $value);
        }
    }
    
    return $result;
}