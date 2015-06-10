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