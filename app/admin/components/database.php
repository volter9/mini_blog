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
    $query = 'SELECT %s FROM %s ORDER BY id DESC';
    
    return paginate_query(sprintf($query, $fields, $table), array(), $limit, $page);
}

/**
 * Find a row in database
 * 
 * @param string $table
 * @param string $fields
 * @param string $id
 * @return array|bool
 */
function db_find ($table, $id) {
    $query = 'SELECT * FROM %s WHERE id = ?';
    
    return db_select(sprintf($query, $table), array($id), true);
}

/**
 * @param string $table
 * @param string $id
 * @return bool
 */
function db_remove ($table, $id) {
    return db_delete($table, array('id[=]' => $id));
}