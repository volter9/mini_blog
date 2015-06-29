<?php

/**
 * Settings module initialize
 */
function settings_module_init () {
    load_model('settings', module_path('settings', 'models', true));
    
    if ($language = storage('settings.default.language')) {
        lang('settings.default', $language);
    }
}