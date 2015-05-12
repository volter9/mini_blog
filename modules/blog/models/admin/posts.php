<?php

/**
 * Posts form description
 * 
 * @return array
 */
function posts_module_describe () {
    return array(
        'fields'   => 'title, description',
        'per_page' => 5,
        
        'templates' => array(
            'modify' => module_path('blog', 'views/form')
        ),
        
        'form' => array(
            'title' => 'input',
            'text'  => 'markdown'
        )
    );
}

/**
 * Users form validation rules
 * 
 * @return array
 */
function posts_module_rules () {
    return array(
        'title' => 'required|max_length:40|no_html',
        'text'  => 'required'
    );
}

/**
 * Filter posts data
 * 
 * @param array $data
 */
function posts_module_filter ($data) {
    $data = array_merge(array(
        'url'         => '',
        'description' => before(' ', $data['text'])
    ), $data);
    
    if (!$data['url']) {    
        $url = preg_replace('/[^\w\d\-_]+/i', '-', transliterate($data['title']));
        $url = trim($url, '-');
    
        array_set($data, 'url', strtolower($url));
    }
    
    array_set($data, 'user_id', array_get($data, 'user_id', users('user.id')));
    
    return $data;
}