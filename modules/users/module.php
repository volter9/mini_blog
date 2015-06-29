<?php

/**
 * Users module
 * 
 * @package mini_blog
 */

/**
 * Users module initialize
 */
function users_module_init () {
    $path = module_path('users', 'models', true);
    
    load_model('users', $path);
}