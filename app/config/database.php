<?php

/**
 * Database configuration
 * 
 * - autoload - automatically connect on boot to database
 * - default - connection group by default
 */

return array(
    'autoload' => true,
    'default'  => array(
        'name'     => 'mini_blog',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => '',
        'charset'  => 'utf8'
    )
);