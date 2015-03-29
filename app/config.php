<?php

/**
 * App's config
 */

return [
    'database' => [
        'autoload' => true,
        'default' => [
            'host'     => 'localhost',
            'user'     => 'root',
            'name'     => 'mini_blog',
            'password' => '',
            'charset'  => 'utf8'
        ]
    ],
    
    'templates' => [
        'directory' => FFF_BASEPATH . 'templates/',
        'template' => 'minimalism'
    ],
    
    'routing' => [
        'base_url' => 'http://php.sandbox/',
        'symbols' => [
            '/:any' => '/?([\d\w\-_]+)',
            '/:num' => '/?(\d+)'
        ]
    ],
    
    'hooks' => [
        FFF_APP_DIR . 'bootstrap',
        FFF_APP_DIR . 'routes',
        FFF_APP_DIR . 'admin/routes'
    ],
    
    'autoload' => [
        'models' => ['users']
    ],
    
    'i18n' => [
        'default' => 'ru_RU'
    ]
];