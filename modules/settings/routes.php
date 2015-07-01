<?php

/**
 * Settings routes
 */

$path = module_path('settings', 'actions');

route('POST #admin_settings_post /admin/settings/:any?', "$path/index:save");