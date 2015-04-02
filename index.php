<?php

/**
 * mini_blog is a simple blog CMS written in procedural/functional PHP5 
 * using FFFramework
 *
 * @author volter9
 * @package mini_blog
 */

/**
 * mini_framework constants
 * 
 * @const string FFF_BASEPATH Base path of the CMS
 * @const string FFF_APP_DIR Path of app dir (app/)
 */
define('FFF_BASEPATH', __DIR__ . '/');
define('FFF_APP_DIR' , __DIR__ . '/app/');

define('MB_DEBUG'   , true);
define('MB_VERSION', 'v1.0');

$time = microtime(true);

require 'vendor/autoload.php';

/** Boot the app */
app_boot(sprintf('%sconfig', FFF_APP_DIR));

/** Showing debug information */
defined('MB_DEBUG') and printf(
    '<!-- Execution time: %.5f, Memory usage: %s, URL: %s -->', 
    microtime(true) - $time, 
    memory_get_usage(true), 
    get_url()
);