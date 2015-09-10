<?php

/**
 * Output JSON result
 * 
 * @param bool $condition
 * @param array $data
 * @param string $message
 */
function json_result ($condition, $data = array(), $message = '') {
    $data['status']  = $condition ? 'ok' : 'error';
    $data['message'] = $message;
    
    echo json($data);
}

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_get ($module, $id) {
    $item = db_find($module, $id);
    
    json_result($item, compact('item'));
}

/**
 * Get the template for specific module
 * 
 * @param string $module
 */
function action_template ($module) {
    $data = admin_data($module);
    
    $html = capture(function () use ($module, $data) {
        snippet("snippets/$module", $data);
    });
    
    json_result(true, compact('data', 'html'));
}

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 */
function action_add ($module) {
    $data = admin("$module.default");
    $data = is_array($data) ? $data : array()
    
    $data = array_merge($data, input());
    $data = admin_filter($module, array_merge(
        $data, 
        array('id' => 0)
    ));
    
    $id = db_insert($module, $data);
    
    json_result($id, compact('id', 'data'));
}

/**
 * Edit an item in $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_edit ($module, $id) {
    $data = admin_filter($module, array_merge(
        input(), 
        compact('id')
    ));
    
    $result = db_edit($module, $data, $id);
    
    json_result($result, compact('data'));
}

/**
 * Remove an item $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_remove ($module, $id) {
    json_result(db_remove($module, $id));
}

/**
 * Providers
 * 
 * @param string $provider
 */
function action_provider ($provider) {
    $providers = modules_providers();
    $provider  = array_get($providers, $provider);
    
    json_result($provider, array(
        'result' => is_callable($provider) ? $provider() : null
    ));
}