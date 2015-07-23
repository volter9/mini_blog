<?php

/**
 * Blog data providers
 * 
 * @package mini_blog
 */

return array(
    'categories' => function () {
        $categories = db_select('SELECT id as value, title FROM categories');
        
        array_unshift($categories, array(
            'title' => 'Без категории',
            'value' => 0
        ));
        
        return $categories;
    }
);