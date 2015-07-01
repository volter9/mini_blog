<?php

/**
 * Add an item from post to $module's table
 * 
 * @param string $module
 */
function action_add ($module) {
    $result = db_insert($module, input());
    
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