<?php 

/**
 * Form data providers
 * 
 * @author volter9
 * @package mini_blog
 */

return array(
    'langauges' => function () {
        return require module_path('settings', 'i18n/languages.php');
    }
);