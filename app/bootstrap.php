<?php

/**
 * Bootstrap hook.
 * 
 * Anything related to custom intialization or PHP system 
 * tweaks goes here. Here's custom handler of exceptions and
 * error reporting to show all errors and notices.
 * 
 * Anything related to bootstrap can be included here.
 * 
 * @package mini_blog
 */

$config = storage('config');

ob_start();
session_start();

date_default_timezone_set($config('mini_blog.timezone'));
mb_internal_encoding('UTF-8');

/**
 * In case of errors, throw exception instead, if debug option is enabled.
 * 
 * Even for pesky notices and warnings.
 */
set_error_handler(function ($type, $message, $file, $line) {
    $file = exclude($file, MF_BASEPATH);
    
    if (defined('MB_DEBUG')) {
        show_error(new Exception(
            "PHP error has occured: '$message' in '$file' at $line"
        ));
    }
    
    die('Something went wrong!');
});

/**
 * Set exception handler for showing up page with information about last
 * exception, in debug mode.
 */
set_exception_handler(function ($e) {
    if (defined('MB_DEBUG')) {
        show_error($e);
    }
    
    die('Something went wrong!');
});

/**
 * Load up custom theme functions
 */
bind('router:found', function () {
    $functions = asset_path('functions.php');
    
    if (file_exists($functions)) {
        require $functions;
    }
});

modules_load($config('mini_blog.modules'));