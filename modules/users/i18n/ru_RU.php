<?php

return array(
    'users' => array(
        'title'  => 'Пользователи',
        'add'    => 'Добавить пользователя',
        'edit'   => 'Редактировать пользователя',
        'remove' => 'Удалить пользователя',
        
        'denied' => array(
            'title'       => 'Отаказано в доступе',
            'description' => 'К сожалению Вы не можете получить доступ к этой странице '
                           . 'или к этому действию.'
        ),
    
        'fields' => array(
            'username' => 'Имя',
            'password' => 'Пароль',
            'mail'     => 'Адрес почты',
            'group_id' => 'Группа'
        ),
    
        'tooltips' => array(
            'username' => 'Имя пользователя (логин)',
            'password' => 'Пароль пользователя',
            'mail'     => 'Почтовый ящик пользователя',
            'group_id' => 'Группа пользователя'
        )
    )
);