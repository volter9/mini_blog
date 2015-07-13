<?php

/**
 * Authorize user
 */
function action_index () {
    $username = input('username');
    $password = input('password');
    
    $user = user_for_auth($username, md5($password));
    
    if (!$user) {
        return false;
    }
    
    session('user_id', $user['id']);
    
    echo json_encode($user);
}

/**
 * Signout out
 */
function action_signout () {
    if (users('authorized')) {
        session_destroy();
    }
    
    redirect('#index');
}