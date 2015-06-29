<?php

$path = module_path('settings', 'actions');

route('GET #admin_settings /admin/settings/:any?', "$path/index");
route('POST #admin_settings_post /admin/settings/:any?', "$path/index:save");