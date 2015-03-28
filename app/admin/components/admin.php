<?php

/**
 * Check if the modules exists (according to existance of two functions)
 * Module should contain two functions: 
 * 
 * - %module_name%_rules (validation rules)
 * - %module_name%_describe (form and module description)
 * 
 * @param string $module
 * @return bool
 */
function admin_module_exists ($module) {
    return function_exists("{$module}_rules") 
        && function_exists("{$module}_describe");
}

/**
 * Get module validation rules
 * 
 * @param string $module
 * @return array
 */
function admin_module_rules ($module) {
    $function = "{$module}_rules";
    
    return $function();
}

/**
 * Get module form and fields description
 * 
 * @param string $module
 * @return array
 */
function admin_describe_module ($module) {
    $function = "{$module}_describe";
    
    return $function();
}