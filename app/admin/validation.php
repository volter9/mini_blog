<?php

/**
 * Custom validation rules
 */

return [
    'rules' => [
        'auth' => [
            'username' => 'required|min_length:4|max_length:20|alpha_dash',
            'password' => 'required|min_length:4|max_length:20|alpha_dash'
        ]
    ],
    
    'fields' => [
        'username' => 'Username',
        'password' => 'Password'
    ]
];