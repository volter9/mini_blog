<?php

/**
 * Settings routes
 */

$path = module_path('settings', 'actions');

route('POST #admin_settings_save /admin/settings/save/:any?', "$path/index:save");
route('GET #admin_settings_get /admin/settings/get/:any?', "$path/index:get");