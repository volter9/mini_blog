<?php

/**
 * Admin container
 * 
 * @param mixed $key
 * @param mixed $value
 * @return mixed
 */
function admin ($key = null, $value = null) {
    static $repo = null;
    
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Get admin data
 * 
 * @param string $module
 * @return array
 */
function admin_data ($module) {
    $template = admin($module);
    $default  = array_get($template, 'default', array());
    
    $keys = array_get($template, 'keys', array());
    $data = array_fill_keys($keys, '');
    
    return array_merge($data, $default);
}

/**
 * Filter data
 * 
 * @param string $module
 * @param array $data
 */
function admin_filter ($module, array $data) {
    $data = array_extract($data, admin("$module.keys"));
    
    $filter = admin("$module.filters");
    
    foreach ($filter as $key => $filters) {
        foreach ($filters as $function) {
            $data[$key] = $function($data[$key]);
        }
    }
    
    return $data;
}