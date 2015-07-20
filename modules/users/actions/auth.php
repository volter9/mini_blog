<?php

/**
 * View the form
 */
function action_view () {
    layout(module_path('users', 'views/form'), array(
        'title' => 'Log in'
    ));
}

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
    
    if (is_ajax()) {
        echo json_encode($user);
    }
    else {
        redirect('#index');
    }
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

?>