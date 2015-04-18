<?php

/**
 * App's config
 */

return array(
    'database' => array(
        'autoload' => true,
        'default'  => array(
            'host'     => '127.0.0.1',
            'user'     => 'root',
            'name'     => 'mini_blog',
            'password' => '',
            'charset'  => 'utf8'
        )
    ),
    
    'templates' => array(
        'directory' => MF_BASEPATH . 'templates/',
        'template'  => 'minimalism',
        'layout'    => 'main'
    ),
    
    'routing' => array(
        'base_url' => 'http://php.sandbox/',
        'symbols' => array(
            '/:any' => '/?([\d\w\-_]+)',
            '/:num' => '/?(\d+)'
        )
    ),
    
    'hooks' => array(
        MF_APP_DIR . 'bootstrap'
    ),
    
    'autoload' => array(
        'models' => array('users'),
        'files'  => array(
            'app/components/loader',
            'app/components/modules'
        )
    ),
    
    'i18n' => array(
        'default' => 'ru_RU'
    ),
    
    'validation' => array(
        'validators' => 'validators'
    )
);