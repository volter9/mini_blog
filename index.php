<?php

/**
 * mini_blog is a simple blog CMS written in procedural/functional PHP5 
 * using mini_framework framework
 * 
 * This CMS suppose to work on PHP5.3+
 * 
 * @author volter9
 * @package mini_blog
 */

/**
 * mini_blog constants
 * 
 * @const string MB_VERSION Version string
 * @const float MB_START Execution time started
 * @const bool MB_DEBUG Debug flag
 */
define('MB_VERSION', 'v1.3');
define('MB_START'  , microtime(true));
define('MB_DEBUG'  , true);

/**
 * mini_framework constants
 * 
 * @const string MF_BASEPATH Base path of the CMS
 * @const string MF_APP_DIR Path of app dir (app/)
 */
define('MF_BASEPATH', chop(__DIR__, '/') . '/');
define('MF_APP_DIR' , chop(__DIR__, '/') . '/app/');

/**
 * Setting error display based on MB_DEBUG constant
 * existance (if it's exists, errors are shown)
 */
ini_set('display_errors', defined('MB_DEBUG'));
error_reporting(-defined('MB_DEBUG'));

/**
 * Requiring installer and exit, if installer exists.
 * Otherwise unset global $install variable
 */
$install = MF_BASEPATH . 'install/index.php';

if (file_exists($install)) {
    return require $install;
}

unset($intall);

/**
 * Requiring composer's autoload and booting the application
 */
require 'vendor/autoload.php';

app_boot(app_path('config'));