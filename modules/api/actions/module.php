<?php

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_get ($module, $id) {
    $result = db_find($module, $id);
    
    echo json(array(
        'status' => $result ? 'ok' : 'error',
        'item'   => $result
    ));
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
    
    echo json(array(
        'status' => 'ok',
        'data'   => $data,
        'html'   => $html
    ));
}

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 */
function action_add ($module) {
    $data = admin("$module.default");
    $data = array_merge(is_array($data) ? $data : array(), input());
    $data = admin_filter($module, $data);
    $result = db_insert($module, $data);
    
    echo json(array(
        'status' => $result ? 'ok' : 'error',
        'id'     => $result
    ));
}

/**
 * Edit an item in $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_edit ($module, $id) {
    $data = admin_filter($module, input());
    $result = db_edit($module, $data, $id);
    
    echo json(array(
        'status' => $result ? 'ok' : 'error',
    ));
}

/**
 * Remove an item $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_remove ($module, $id) {
    $result = db_remove($module, $id);
    
    echo json(array(
        'status' => $result ? 'ok' : 'error',
    ));
}

/**
 * Providers
 * 
 * @param string $provider
 */
function action_provider ($provider) {
    $providers = modules_providers();
    $provider  = array_get($providers, $provider);
    
    echo json(array(
        'status' => $provider ? 'ok' : 'error',
        'result' => is_callable($provider) ? $provider() : null
    ));
}