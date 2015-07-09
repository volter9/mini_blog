<?php

/**
 * Admin templates storage
 * 
 * @param mixed $key
 * @param mixed $value
 * @return mixed
 */
function admin_templates ($key = null, $value = null) {
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
    $template = admin_templates($module);
    $default  = array_get($template, 'default', array());
    
    $keys = array_get($template, 'keys', array());
    $data = array_fill_keys($keys, '');
    
    return array_merge($data, $default);
}

/**
 * 
 * 
 * 
 */
function admin_filter ($module, $data) {
    
}