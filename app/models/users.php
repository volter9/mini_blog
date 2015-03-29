<?php

/**
 * Users storage function
 * 
 * @param string $key
 * @param mixed $value
 * @return mixed
 */
function users ($key = null, $value = null) {
    static $repo = null;
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Init users
 */
function users_init () {
    $user = user_by_id(+session('user_id'));
    
    if ($user) {
        users('user', $user);
        users('authorized', true);
    }
    else {
        session('user_id', false);
    }
}

/**
 * Get user by id
 * 
 * @param int $id
 * @return array|bool
 */
function user_by_id ($id) {
    return db_select('
        SELECT * 
        FROM users
        WHERE id = ?',
        [$id], true
    );
}

/**
 * Get user for authorization
 * 
 * @param string $username
 * @param string $password
 * @return array|bool
 */
function user_for_auth ($username, $password) {
    return db_select('
        SELECT id, username, password
        FROM users
        WHERE username = ? AND password = ?',
        [$username, $password], true
    );
}

/**
 * Users form description
 * 
 * @return array
 */
function users_describe () {
    return [
        'fields' => 'username, mail',
        'per_page' => 10,
        'form' => [
            'username' => 'input',
            'password' => 'password',
            'mail' => 'input',
            'group_id' => 'select:groups',
        ]
    ];
}

/**
 * Users form validation rules
 * 
 * @return array
 */
function users_rules () {
    return [
        'username' => 'required|max_length:20|min_length:6|alpha_dash|unique:users.username',
        'password' => 'required|max_length:20|min_length:6|alpha_dash',
        'mail' => 'required|valid_mail|max_length:40|unique:users.mail',
        'group_id' => 'required|is_numeric'
    ];
}