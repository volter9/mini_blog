<?php

/**
 * Group storage function
 *
 * @param mixed $key
 * @param mixed $value
 * @return mixed
 */
function groups ($key = null, $value = null) {
    static $repo = null;
    
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Route to group
 * 
 * @param string $id
 * @param array $matches
 * @return string
 */
function route_to_group ($id, array $matches) {
    $id = after($id, '#');
    
    if (!empty($matches)) {
        $parameters = implode(',', $matches);
        
        $id = "$id:$parameters";
    }
    
    return $id;
}