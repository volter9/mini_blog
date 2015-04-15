<?php

return array(
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
    ),
    
    'categories' => array(
        'title'  => 'Категории',
        'add'    => 'Добавить категорию',
        'edit'   => 'Редактировать категорию',
        'remove' => 'Удалить категорию',
        
        'fields' => array(
            'title'       => 'Заголовок',
            'url'         => 'URL фрагмент',
            'description' => 'Описание',
        ),
        
        'tooltips' => array(
            'title'       => 'Заголовок вашей категории',
            'url'         => 'URL фрагмент категории в адресной строке',
            'description' => 'Описание категории',
        ),
    ),
    
    'users' => array(
        'title'  => 'Пользователи',
        'add'    => 'Добавить пользователя',
        'edit'   => 'Редактировать пользователя',
        'remove' => 'Удалить пользователя',
        
        'fields' => array(
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'mail'     => 'Элекронный адрес почты',
            'group_id' => 'Группа пользователя'
        ),
        
        'tooltips' => array(
            'username' => 'Имя пользователя (логин)',
            'mail'     => 'Почтовый ящик пользователя',
            'group_id' => 'Группа пользователя'
        )
    )
);