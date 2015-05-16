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
    layout('index', array(
        'title' => 'Welcome!'
    ));
}

/**
 * Admin authorization 
 */
function action_auth () {
    view_auth_action();
}

/**
 * Admin authorization view
 * 
 * @param array $errors
 * @param array $input
 */
function view_auth_action ($errors = '', array $input = array()) {
    if (users('authorized')) {
        redirect('#admin_index');
    }
    
    view('layouts/auth', array(
        'title' => 'Login',
        
        'scheme' => array(
            'view'   => 'forms/basic',
            'action' => url('#auth_login'),
            'submit' => lang('admin.auth.login'),
            'form'   => auth_form()
        ),
        
        'data' => array(
            'error' => $errors,
            'input' => $input,
            'field' => lang('admin.auth.fields')
        )
    ));
}

/**
 * POST action of admin authorization
 */
function action_login () {
    $input = input();
    
    validation_init(lang('admin.auth.fields'), i18n('messages'));
    
    $user = user_for_auth(
        array_get($input, 'username'), 
        md5(array_get($input, 'password'))
    );
    
    if (validate($input, auth_rules()) && $user) {
        session('user_id', $user['id']);
        
        redirect('#admin_index');
    }
    
    $errors = validation_errors();
    
    if (!$user && !$errors) {
        $errors[] = i18n('messages.no_user');
    }
    
    view_auth_action($errors, $input);
}

/**
 * Get authorization rules
 * 
 * @return array
 */
function auth_rules () {
    return array(
        'username' => 'required|min_length:4|max_length:20|alpha_dash',
        'password' => 'required|min_length:4|max_length:20|alpha_dash'
    );
}

/**
 * Get auth form description
 * 
 * @return array
 */
function auth_form () {
    return array(
        'username' => 'input',
        'password' => 'password'
    );
}

/**
 * Signout
 */
function action_signout () {
    session_destroy() and redirect('#index');
}