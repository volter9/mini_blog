<?php

/**
 * Snippets API
 * 
 * @package mini_blog
 */

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
    
    $snippet = require view_path($path);
    $snippet($data);
    
    snippets($path, $snippet);
}

/**
 * Capture output and return it as string
 * 
 * @param callable $callback
 * @return string
 */
function capture ($callback) {
    ob_start();
    
    $callback();
    
    return ob_get_clean();
}