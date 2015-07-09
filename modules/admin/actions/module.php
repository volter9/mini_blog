<?php

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_get ($module, $id) {
    $result = db_find($module, $id);
    
    echo json_encode(array(
        'status' => $result ? 'ok' : 'not_ok',
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
    
    echo json_encode(array(
        'status' => 'ok',
        'data'   => $data,
        
        'html' => capture(function () use ($module, $data) {
            snippet("snippets/$module", $data);
        })
    ));
}

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 */
function action_add ($module) {
    $data = array_extract(input(), admin_templates("$module.keys"));
    $result = db_insert($module, $data);
    
    echo json_encode(array(
        'status' => $result ? 'ok' : 'not_ok',
    ));
}

/**
 * Edit an item in $module's table
 * 
 * @param string $module
 * @param string $id
 */
function action_edit ($module, $id) {
    $result = db_edit($module, input(), $id);
    
    echo json_encode(array(
        'status' => $result ? 'ok' : 'not_ok',
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
    
    echo json_encode(array(
        'status' => $result ? 'ok' : 'not_ok',
    ));
}