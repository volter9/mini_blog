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
            'category_id' => 'Категория'
        ),
        
        'tooltips' => array(
            'title'       => 'Дайте отличный заголовок для вашей записи',
            'url'         => 'Индетификатор статьи в URL',
            'description' => 'Мета описание записи',
            'text'        => 'Тут Ваши мысли, можно использовать HTML или <a href="http://rukeba.com/by-the-way/markdown-sintaksis-po-russki/" target="_blank">Markdown</a>',
            'user_id'     => 'Пользователь который владеет данной записью',
            'category_id' => 'Категория необязательна'
        )
    ),
    
    'categories' => array(
        'title'  => 'Категории',
        'add'    => 'Добавить категорию',
        'edit'   => 'Редактировать категорию',
        'remove' => 'Удалить категорию',
    )
);