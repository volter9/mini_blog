<?php

/**
 * Users routes
 * 
 * - Authenticate/Log in
 * - Sign out
 */

$path = module_path('users', 'actions');

route('POST #auth /auth', "$path/auth");
route('* #signout /signout', "$path/auth:signout");