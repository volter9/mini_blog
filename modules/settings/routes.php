<?php

/**
 * Settings routes
 */

$path = module_path('settings', 'actions');

route('POST #api_settings_save /api/settings/save/:any?', "$path/index:save");
route('GET #api_settings_get /api/settings/get/:any?', "$path/index:get");