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

function setting ($key) {
    return settings("all_settings.$key");
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
    
    settings('all_settings.default', settings_get('default'));
}

/**
 * Get settings by group
 * 
 * @param string $group
 * @return array|bool
 */
function settings_get ($group) {
    $settings = db_select('
        SELECT id, name, `value`
        FROM settings
        WHERE `group` = ?', 
        array($group)
    );
    
    $settings = $settings ? $settings : array();
    
    return array_combine(
        pluck($settings, 'name'),
        pluck($settings, 'value')
    );
}

/**
 * Save settings
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