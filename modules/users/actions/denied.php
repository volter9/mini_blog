<?php

/**
 * Access deny page
 */
function action_index () {
    layout(
        module_path('users', 'views/denied'), 
        lang('admin.users.denied')
    );
}