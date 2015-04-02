<?php

/**
 * Core module
 * 
 * @package mini_blog
 */

function core_module_init () {
    $default = lang('settings.default');
    
    lang('admin', load_app_file("modules/core/i18n/$default"));
    
    module_register('posts', 'core/models/posts');
    module_register('categories', 'core/models/categories');
    module_register('users', 'core/models/users');
}