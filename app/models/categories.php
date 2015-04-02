<?php

/**
 * Get all categories
 * 
 * @return array|bool
 */
function categories_all () {
    return db_select('SELECT * FROM categories');
}

/**
 * Get a category by url
 * 
 * @param string $url
 * @return array|bool 
 */
function category_by_url ($url) {
    return db_select('
        SELECT * FROM categories 
        WHERE url = ?', 
        [$url], true
    );
}