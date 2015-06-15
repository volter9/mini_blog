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
 * Add admin module
 * 
 * @param string $name
 * @param array $info
 */
function admin_add_module ($name, array $info) {
    groups("route_admin_add:$name", "admin.$name.add");
    groups("route_admin_add_post:$name", "admin.$name.add");
    groups("route_admin_edit:$name,*", "admin.$name.edit");
    groups("route_admin_edit_post:$name,*", "admin.$name.edit");
    groups("route_admin_remove:$name,*", "admin.$name.remove");
    
    admin($name, $info);
}

/**
 * Check if the modules exists (according to existance of two functions)
 * 
 * @param string $module
 * @return bool
 */
function admin_module_exists ($module) {
    return admin($module)
        && function_exists(admin("$module.rules")) 
        && function_exists(admin("$module.description"));
}

/**
 * Get module validation rules
 * 
 * @param string $module
 * @return array
 */
function admin_module_rules ($module) {
    $function = admin("$module.rules");
    
    return $function();
}

/**
 * Get module form and fields description
 * 
 * @param string $module
 * @return array
 */
function admin_describe_module ($module) {
    $function = admin("$module.description");
    
    return $function();
}

/**
 * Get fields labels for module
 *
 * @param string $module
 * @return array
 */
function admin_module_fields ($module) {
    $fields = lang("admin.$module.fields");
    
    return array_merge(
        lang('admin.common.fields'),
        $fields ? $fields : array()
    );
}

/**
 * Filter input for module insert or edit
 * 
 * @param string $module
 * @param array $data
 * @return array
 */
function admin_filter_input ($module, array $data) {
    $input = emit("admin:$module.filter", $data);
    $input = $input ? $input : array();
    
    foreach ($input as $value) {
        $data = array_merge($data, $value);
    }
    
    return $data;
}