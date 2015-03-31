<?php

/**
 * mini_blog is a simple blog CMS written in procedural/functional PHP5 
 * using FFFramework
 *
 * @author volter9
 * @package mini_blog
 */

/**
 * FFFramework constants
 * 
 * @const string FFF_BASEPATH Base path of the CMS
 * @const string FFF_APP_DIR Path of app dir (app/)
 */
define('FFF_BASEPATH', __DIR__ . '/');
define('FFF_APP_DIR' , __DIR__ . '/app/');

define('MB_DEBUG'   , true);
define('MB_VERSION', 'v1.0');

/**
 * у тебя стандартный косяк верстальщиков
 * не задал фон для полей
 * 
 * Про шапку
 * [3/28/15 6:43:47 PM] : Не видел про полупрозрачность
 * [3/28/15 6:44:09 PM] : Тогда тем более надо выделить цветом
 * 
 * Про кнопки под input'ом в админке
 * Для этого есть label и стили задаются противоположно
 */

$time = microtime(true);

require 'vendor/autoload.php';

/** Boot the app */
app_boot(sprintf('%sconfig', FFF_APP_DIR));

/** Showing debug information */
defined('MB_DEBUG') and printf(
    '%s<!-- Execution time: %.5f, Memory usage: %s, URL: %s -->', 
    "\n", microtime(true) - $time, memory_get_usage(true), get_url()
);