<?php

/**
 * Users routes
 * 
 * - Authenticate/Log in
 * - Sign out
 */

$path = module_path('users', 'actions');

route('POST #auth /auth', "$path/auth");
route('GET #login /auth', "$path/auth:view");
route('* #signout /signout', "$path/auth:signout");