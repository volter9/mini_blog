<?php

/**
 * Admin modules and stuff
 * 
 * @package mini_blog
 */

/**
 * Flatten given array 
 * 
 * @param array $array
 * @return array
 */
function array_flatten (array $array) {
    $result = array();
    
    foreach ($array as $item) {
        if (is_array($item)) {
            $result = array_merge($result, array_flatten(
                array_values($item)
            ));
        }
        else {
            $result[] = $item;
        }
    }
    
    return $result;
}

/**
 * Shortcut for parsedown
 * 
 * @param string $text
 * @return string
 */
function markdown ($text) {
    static $parsedown = null;
    
    if (!$parsedown) {
        $parsedown = new Parsedown;
    }
    
    return $parsedown->text($text);
}

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
            if (isset($data[$key])) {
                $data[$key] = $function($data[$key]);
            }
        }
    }
    
    return $data;
}

/**
 * Get bootstrapped JS strings (for collections)
 * 
 * @return string
 */
function admin_js_bootstrap () {
    $js = '';
    
    foreach (array_pluck(admin(), 'js_bootstrap') as $func) {
        $js .= $func() . "\n";
    }
    
    return $js;
}

/**
 * Get all JS scripts registered by modules
 * 
 * @return array
 */
function admin_scripts () {
    return array_flatten(array_pluck(admin(), 'js'));
}