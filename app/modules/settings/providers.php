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
    },
    
    'templates' => function () {
        $config = storage('config');
        $templates = scandir($config('templates.directory'));
        
        $callback = function ($v) {
            return array(
                'title' => $v,
                'value' => $v
            );
        };
        
        $templates = array_map($callback, $templates);
        
        return array_filter($templates, function ($v) {
            return strpos($v['title'], '.') !== 0;
        });
    }
);