<?php

/**
 * Admin's menu function container
 * 
 * @param mixed $key
 * @param mixed $value
 * @return mixed
 */
function menu ($key = null, $value = null) {
    static $repo = null;
    
    $repo or $repo = repo();
    
    return $repo($key, $value);
}

/**
 * Add module to header admin menu
 * 
 * @param string $module
 * @param string $title
 * @param string $url
 */
function menu_add_item ($module, $title, $url) {
    menu($module, array(
        'title'   => $title,
        'url'     => $url,
        'submenu' => array()
    ));
}

/**
 * Add menu subitem to module
 * 
 * @param string $module
 * @param string $title
 * @param string $url
 */
function menu_add_subitem ($module, $title, $url) {
    $submenu = menu("$module.submenu");
    
    $submenu[] = array(
        'title' => $title,
        'url'   => $url
    );
    
    menu("$module.submenu", $submenu);
}