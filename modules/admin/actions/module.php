<?php

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 */
function action_add ($module) {
    $data   = input();
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
    $data   = input();
    $result = db_edit($module, $data, $id);
    
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