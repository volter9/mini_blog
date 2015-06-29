<?php

/**
 * Users routes
 * 
 * @package mini_blog
 */

$path = module_path('users', 'actions');

route('GET #admin_denied /admin/denied', "$path/denied:index");