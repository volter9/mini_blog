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

$callback = function ($e) {
    defined('MB_DEBUG') and show_error($e);
    
    die('Something went wrong!');
};

set_error_handler(function ($type, $message, $file, $line) use ($callback) {
    $file = exclude($file, MF_BASEPATH);
    
    $callback(new Exception("PHP error: '$message' in '$file' at $line"));
});

set_exception_handler($callback);

/**
 * Load up custom theme functions
 */
bind('router:found', function () {
    file_exists($functions = asset_path('functions.php')) and require $functions;
});

modules_load($config('mini_blog.modules'));