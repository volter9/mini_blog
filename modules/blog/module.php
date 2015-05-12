<?php

/**
 * Blog module initialize
 */
function blog_module_init () {
    load_language('app', module_path('blog', 'i18n/site'));
}

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
 * Initialize admin section module
 */
function blog_module_admin_init () {
    load_language('admin', module_path('blog', 'i18n/admin'));
    
    load_php(module_path('blog', 'models/admin/posts'));
    
    menu_add_item('posts', "admin.posts.title", '#admin_view', array('posts'));
    menu_add_subitem('posts', "admin.posts.add", '#admin_add', array('posts'));
    
    bind('admin:posts.filter', 'posts_module_filter');
}