<?php

/**
 * View the form
 */
function action_view () {
    ?>
    <form method="POST">
        <input name="username" placeholder="user name" type="text"/> <br/>
        <input name="password" placeholder="password" type="text"/> <br/>
        <button type="submit">Log in!</button>
    </form>
    <?php
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