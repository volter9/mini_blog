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
        'directory' => MF_BASEPATH . 'templates/',
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
        MF_APP_DIR . 'bootstrap',
        MF_APP_DIR . 'routes',
        MF_APP_DIR . 'admin/routes'
    ],
    
    'autoload' => [
        'models' => ['users'],
        'files'  => [
            'app/admin/components/loader',
            'app/admin/components/admin',
            'app/admin/components/modules'
        ]
    ],
    
    'i18n' => [
        'default' => 'ru_RU'
    ]
];