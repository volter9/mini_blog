<?php

/**
 * Bootstrap hook.
 * 
 * Anything related to custom intialization or PHP system 
 * tweaks goes here. Here's custom handler of exceptions and
 * error reporting to show all errors and notices.
 * 
 * Anything related to bootstrap can be included here.
 */

ob_start();
session_start();

ini_set('display_errors', defined('FFF_DEBUG'));
error_reporting(-defined('FFF_DEBUG'));

date_default_timezone_set('America/Los_Angeles');
mb_internal_encoding('UTF-8');

load_api('i18n');
load_language('app', 'app/i18n/en_US');

set_exception_handler(function ($e) {
    !defined('FFF_DEBUG') or show_error($e);
});