<?php

/**
 * App's config
 */

return array(
    'database' => array(
        'autoload' => true,
        'default'  => array(
            'host'     => 'localhost',
            'user'     => 'root',
            'name'     => 'mini_blog',
            'password' => '',
            'charset'  => 'utf8'
        )
    ),
    
    'templates' => array(
        'directory' => MF_BASEPATH . 'templates/',
        'template'  => 'minimalism'
    ),
    
    'routing' => array(
        'base_url' => 'http://php.sandbox/',
        'symbols' => array(
            '/:any' => '/?([\d\w\-_]+)',
            '/:num' => '/?(\d+)'
        )
    ),
    
    'hooks' => array(
        MF_APP_DIR . 'bootstrap',
        MF_APP_DIR . 'routes',
        MF_APP_DIR . 'admin/routes'
    ),
    
    'autoload' => array(
        'models' => array('users'),
        'files'  => array(
            'app/admin/components/loader',
            'app/admin/components/admin',
            'app/admin/components/modules'
        )
    ),
    
    'i18n' => array(
        'default' => 'ru_RU'
    ),
    
    'validation' => array(
        'validators' => 'validators'
    )
);