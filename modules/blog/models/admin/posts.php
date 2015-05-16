<?php

/**
 * Transliterate text
 * 
 * @param string $text
 * @return string
 */
function transliterate ($text = null) {
    static $cyrillic = array(
        'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 
        'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я', 'ы',
        'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 
        'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я', 'Ы'
    );
    
    static $latin = array(
        'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 
        'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', '', 'ya', 'y',
        'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 
        'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', '', 'Ya', 'Y'
    );
    
    if ($text) {
        return str_replace($cyrillic, $latin, $text);
    }
    
    return null;
}

/**
 * Posts form description
 * 
 * @return array
 */
function posts_module_describe () {
    return array(
        'fields'   => 'title, description',
        'per_page' => 6,
        
        'template' => array(
            'view'   => module_path('blog', 'views/view'),
            'modify' => module_path('blog', 'views/form')
        ),
        
        'form' => array(
            'title' => 'input',
            'text'  => 'text'
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
    if (!isset($data['url'])) {
        $url = preg_replace('/[^\w\d\-_]+/i', '-', transliterate($data['title']));
        $url = trim($url, '-');
    
        array_set($data, 'url', strtolower($url));
    }
    
    array_set($data, 'user_id', array_get($data, 'user_id', users('user.id')));
    
    return $data;
}