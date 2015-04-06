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
    return modules($module)
        && function_exists("{$module}_module_rules") 
        && function_exists("{$module}_module_describe");
}

/**
 * Get module validation rules
 * 
 * @param string $module
 * @return array
 */
function admin_module_rules ($module) {
    $function = "{$module}_module_rules";
    
    return $function();
}

/**
 * Get module form and fields description
 * 
 * @param string $module
 * @return array
 */
function admin_describe_module ($module) {
    $function = "{$module}_module_describe";
    
    return $function();
}

/**
 * Filter input for module insert or edit
 * 
 * @param string $module
 * @param array $data
 * @return array
 */
function admin_filter_input ($module, array $data) {
    $function = "{$module}_module_filter";
    
    return function_exists($function) ? $function($data) : $data;
}