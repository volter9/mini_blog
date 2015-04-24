<?php

/**
 * mini_blog is a simple blog CMS written in procedural/functional PHP5 
 * using mini_framework framework
 *
 * @author volter9
 * @package mini_blog
 */

/**
 * mini_blog constants
 * 
 * @const string MB_VERSION Version string
 * @const bool MB_DEBUG Debug flag
 */
define('MB_VERSION', 'v1.1.1');
define('MB_DEBUG'  , true);

/**
 * mini_framework constants
 * 
 * @const string MF_BASEPATH Base path of the CMS
 * @const string MF_APP_DIR Path of app dir (app/)
 */
define('MF_BASEPATH', __DIR__ . '/');
define('MF_APP_DIR' , __DIR__ . '/app/');

/**
 * Setting error display based on MB_DEBUG constant
 * existance (if it's exists, errors are shown)
 */
ini_set('display_errors', defined('MB_DEBUG'));
error_reporting(-defined('MB_DEBUG'));

$time    = microtime(true);
$install = MF_BASEPATH . 'install/index.php';

/**
 * Requiring installer and exit, if installer exists 
 * and that's all in one line. Pretty smart, huh? :)
 */
file_exists($install) and (require $install) and exit;

/**
 * Requiring composer's autoload and booting the
 * application
 */
require 'vendor/autoload.php';

app_boot(sprintf('%sconfig', MF_APP_DIR));

/**
 * Debug information
 * 
 * If MB_DEBUG is defined, then HTML comment
 * would be displayed at bottom of the source page
 * with following information
 * 
 * - Execution time
 * - Real memory usage (according to PHP)
 * - Current routing URL
 */
defined('MB_DEBUG') and printf(
    '<!-- Execution time: %.5f, Memory usage: %s, URL: %s, files: %s -->', 
    microtime(true) - $time, 
    memory_get_usage(true), 
    get_url(),
    count(get_included_files())
);