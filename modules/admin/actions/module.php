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

function action_snippet ($module) {
    $data = array(
        'id' => '',
        'url' => '',
        'title' => '',
        'description' => '',
        'text' => '',
        'username' => '',
        'date' => ''
    );
    
    echo json_encode(array(
        'status' => 'ok',
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