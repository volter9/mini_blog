<?php

/**
 * Initialize index 
 */
function actions_init () {
    load_api('forms');
    load_api('validation');
}

/**
 * Main dashboard
 */
function action_index () {
    redirect('#admin_view', ['posts']);
}

/**
 * Admin authorization 
 */
function action_auth () {
    view_auth_action(config('app/admin/validation'));
}

/**
 * Admin authorization view
 * 
 * @param Closure $config
 * @param array $errors
 * @param array $input
 */
function view_auth_action (Closure $config, $errors = '', $input = []) {
    if (users('authorized')) {
        redirect('#admin_index');
    }
    
    view('auth', [
        'title' => 'Login',
        'scheme' => [
            'view' => 'forms/simple',
            'action' => url('#auth_login'),
            'submit' => 'Login',
            'form' => [
                'username' => 'input',
                'password' => 'password'
            ]
        ],
        'data' => [
            'errors' => $errors,
            'input'  => $input,
            'field'  => $config('fields')
        ]
    ]);
}

/**
 * POST action of admin authorization
 */
function action_login () {
    $input  = input();
    $config = config('app/admin/validation');
    
    validation_init(load_app_file('validators'), i18n('messages'));
    validation_rules($config('rules.auth'));
    validation_fields($config('fields'));
    
    $username = $input['username'];
    $password = md5($input['password']);
    
    $user = user_for_auth($username, $password);
    
    if (validate($input) && $user) {
        session('user_id', $user['id']);
        
        redirect('#admin_index');
    }
    
    view_auth_action($config, validation_errors(), $input);
}

/**
 * Signout
 */
function action_signout () {
    session_destroy();
    
    redirect('#index');
}