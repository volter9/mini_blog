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

ini_set('display_errors', defined('MB_DEBUG'));
error_reporting(-defined('MB_DEBUG'));

date_default_timezone_set('America/Los_Angeles');
mb_internal_encoding('UTF-8');

$default = lang('settings.default');
load_language('app', "app/i18n/$default");

set_exception_handler(function ($e) {
    !defined('MB_DEBUG') or show_error($e);
});