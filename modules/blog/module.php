<?php

/**
 * mini_blog blog module
 * 
 * This module provides few controllers for viewing and listing posts. 
 * 
 * @author volter9
 * @package mini_blog
 */

/**
 * Blog module initialize
 */
function blog_module_init () {
    load_language('app', module_path('blog', 'i18n'));
    
    admin('posts', array(
        'js' => array(module_url('blog', 'js/module.js'))
    ));
}

/**
 * Add blog admin templates
 */
function blog_module_admin_init () {
    $user = users('user');
    
    $strip = function ($value) { return strip_tags($value); };
    $trim  = function ($value) { return trim($value); };
    
    admin('posts', array(
        'keys' => array(
            'id', 'title', 'url', 'text', 'date'
        ),
        'default' => array(
            'title' => '',
            'text'  => '',
            'date'  => date('Y-m-d H:i:s'),
            'url'   => '',
            'id'    => 0
        ),
        'filters' => array(
            'title' => array($strip, $trim),
            'text'  => array($trim),
            'url'   => array('blog_url')
        )
    ));
}

/**
 * Filter post URL 
 * 
 * @param string $url
 * @param array $data
 * @return string
 */
function blog_url ($url, $data) {
    if ($url === '') {
        return md5(microtime(true));
    }
    
    $found = blog_matched_url($url);
    
    if (
        $found && 
        intval($found['id']) !== intval($data['id'])
    ) {
        $found  = $found['url'];
        $number = blog_url_number($found, $url);
    
        if ($number) {
            $url = preg_replace('/-' . ($number - 1). '/', '', $url);        
            $url .= "-$number";
        }
    }
    
    return $url;
}

/**
 * Get URL slug in posts which similar 
 * 
 * @param string $url
 * @return array
 */
function blog_matched_url ($url) {
    return db_select('
        SELECT id, url 
        FROM posts 
        WHERE url LIKE ? 
        ORDER BY LENGTH(url) DESC, url DESC 
        LIMIT 1',
        array(db_like($url) . '%'), true
    );
}

/**
 * Get the last duplicate identificator in the end of url
 * 
 * @param string $found
 * @param string $url
 * @return int
 */
function blog_url_number ($found, $url) {
    if ($found === $url) {
        return 1;
    }
    
    $url = preg_quote($url, '/');
    
    preg_match("/$url-(\d+)/", $found, $matches);
    
    return isset($matches[1]) ? intval($matches[1]) + 1 : 0;
}