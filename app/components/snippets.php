<?php

/**
 * Snippets repository
 * 
 * @param mixed $key
 * @param mixed $value
 * @return mixed
 */
function snippets ($key = null, $value = null) {
    static $repo = null;
    
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Invoke snippet
 * 
 * @param string $path
 * @param array $data
 */
function snippet ($path, array $data) {
    if ($snippet = snippets($path)) {
        return $snippet($data);
    }
    
    $snippet = view_path($path);
    $snippet = require $snippet;
    
    snippets($path, $snippet);
    
    $snippet($data);
}

function capture ($callback) {
    ob_start();
    
    $callback();
    
    return ob_get_clean();
}