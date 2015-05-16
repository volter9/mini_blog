<?php

return array(
    'blog' => array(
        'title' => 'Блог'
    ),
    
    'posts' => array(
        'title'  => 'Записи',
        'add'    => 'Добавить запись',
        'edit'   => 'Редактировать запись',
        'remove' => 'Удалить запись',
        
        'fields' => array(
            'title'       => 'Заголовок',
            'url'         => 'URL фрагмент',
            'description' => 'Описание',
            'text'        => 'Содержание',
            'user_id'     => 'Автор',
            'category_id' => 'Категория'
        ),
        
        'tooltips' => array(
            'title'       => 'Заголовок вашей записи',
            'url'         => 'URL фрагмент записи в адресной строке',
            'description' => 'Описание записи',
            'text'        => 'Содержание записи, можно использовать HTML или <a href="http://rukeba.com/by-the-way/markdown-sintaksis-po-russki/" target="_blank">Markdown</a>',
            'user_id'     => 'Автор записи',
            'category_id' => 'Категория записи'
        )
    )
);