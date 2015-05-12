<?php 

/**
 * Form data providers
 * 
 * @author volter9
 * @package mini_blog
 */

return array(
    'langauges' => function () {
        return array(
            array(
                'title' => 'English',
                'value' => 'en_US'
            ),
            array(
                'title' => 'Русский',
                'value' => 'ru_RU'
            )
        );
    }
);