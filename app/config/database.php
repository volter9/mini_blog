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
        'host'     => 'localhost',
        'name'     => 'mini_blog',
        'user'     => 'root',
        'password' => '',
        'charset'  => 'utf8'
    )
);