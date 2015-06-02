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
        $privileges = array_map(
            function ($privilege) {
                return trim($privilege);
            },
            explode(',', $user['privileges'])
        );
        
        users('user', $user);
        users('authorized', true);
        users('privileges', $privileges);
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
function is_allowed ($action) {
    $privileges = users('privileges');
    
    return in_array($action, $privileges)
        || in_array('*', $privileges);
}

/**
 * Check for specific role
 * 
 * @param string
 * @return bool
 */
function is_role ($role) {
    return users('user.role') === $role;
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
            g.name as role, g.privileges
        FROM users u
        LEFT JOIN groups g ON (u.group_id = g.id)
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