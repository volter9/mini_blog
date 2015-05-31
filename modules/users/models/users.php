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
    $user = user_by_id((int)session('user_id'));
    
    if ($user) {
        users('user', $user);
        users('privileges', explode(',', $user['privileges']));
        users('authorized', true);
    }
    else {
        session('user_id', false);
    }
}

/**
 * Is user allowed to perform specific action
 * 
 * @param string $action
 * @return bool
 */
function is_user_allowed ($action) {
    $privileges = users('privileges');
    
    return in_array($action, $privileges)
        || in_array('*', $privileges);
}

/**
 * Is user in specific group
 * 
 * @param string $group
 * @return bool
 */
function is_user ($group) {
    return users('user.group_name') === $group;
}

/**
 * Get user by id
 * 
 * @param int $id
 * @return array|bool
 */
function user_by_id ($id) {
    return db_select('
        SELECT 
            u.id, u.username, u.mail, 
            g.name AS group_name, g.privileges
        FROM users u
        LEFT JOIN groups g 
        ON (g.id = u.group_id) 
        WHERE u.id = ?',
        array($id), true
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
        array($username, $password), true
    );
}