<?php 

/**
 * Form data providers
 * 
 * @author volter9
 * @package mini_blog
 */

return [
    'groups' => function () {
        return db_select('
            SELECT id AS value, name AS title 
            FROM groups 
            ORDER BY value DESC
        ');
    },
    
    'users' => function () {
        return db_select('
            SELECT id AS value, username AS title 
            FROM users 
            ORDER BY value DESC
        ');
    },
    
    'categories' => function () {
        return db_select('
            SELECT id AS value, title 
            FROM categories 
            ORDER BY value DESC
        ');
    }
];