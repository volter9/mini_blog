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
 * @param array $args
 */
function menu_add_item ($module, $title, $url, array $args = array()) {
    $group = 'route_';
    $group .= after($url, '#');
    
    if (!empty($args)) {
        $group .= ':' . implode(',', $args);
    }
    
    groups($group, $title);
    
    menu($module, array(
        'title'   => $title,
        'url'     => $url,
        'args'    => $args,
        'submenu' => array()
    ));
}

/**
 * Add menu subitem to module
 * 
 * @param string $module
 * @param string $title
 * @param string $url
 * @param array $args
 */
function menu_add_subitem ($module, $title, $url, array $args = array(), $permissions = true) {
    if (!menu("$module.title")) {
        return;
    }
    
    groups('route_' . after($url, '#') . ':' . implode($args), $title);
    
    menu("$module.submenu", array(
        array(
            'title' => $title,
            'url'   => $url,
            'args'  => $args
        )
    ));
}