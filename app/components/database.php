<?php

/**
 * Browse a table with pagination
 *
 * @param string $table
 * @param string $fields
 * @param int $limit
 * @param int $offset
 * @return array
 */
function db_browse ($table, $fields, $limit, $page = 0) {
    $query = "SELECT $fields FROM $table ORDER BY id DESC";
    
    return paginate_query($query, array(), $limit, $page);
}

/**
 * Find a row in database
 * 
 * @param string $table
 * @param string $id
 * @return array|bool
 */
function db_find ($table, $id) {
    $query = "SELECT * FROM $table WHERE id = ?";
    
    return db_select($query, array($id), true);
}

/**
 * Find a row in database
 * 
 * @param string $table
 * @param array $data
 * @param string $id
 * @return array|bool
 */
function db_edit ($table, array $data, $id) {
    $criteria = ['id[=]' => $id];
    
    return db_update($table, $data, $criteria);
}

/**
 * @param string $table
 * @param string $id
 * @return bool
 */
function db_remove ($table, $id) {
    return db_delete($table, array('id[=]' => $id));
}