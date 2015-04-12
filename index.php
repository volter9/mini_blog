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
 * @const string MF_BASEPATH Base path of the CMS
 * @const string MF_APP_DIR Path of app dir (app/)
 */
define('MF_BASEPATH', __DIR__ . '/');
define('MF_APP_DIR' , __DIR__ . '/app/');

/**
 * mini_blog constants
 * 
 * @const string MB_VERSION Version string
 * @const bool MB_DEBUG Debug flag
 */
define('MB_VERSION', 'v1.1');
define('MB_DEBUG'  , true);

if (file_exists($install = MF_BASEPATH . 'install/index.php')) {
    require $install;
    
    exit;
}

$time = microtime(true);

require 'vendor/autoload.php';

/** Boot the app */
app_boot(sprintf('%sconfig', MF_APP_DIR));

/** Showing debug information */
defined('MB_DEBUG') and printf(
    '<!-- Execution time: %.5f, Memory usage: %s, URL: %s -->', 
    microtime(true) - $time, 
    memory_get_usage(true), 
    get_url()
);