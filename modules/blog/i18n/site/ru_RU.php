<?php 

return array(
    'main' => 'Главная страница',
    
    'header' => array(
        'title' => 'mini_blog',
        'home'  => 'Домой',
        'admin' => 'Админка',
        'latests' => 'Последние заметки'
    ),
    
    'footer' => array(
        'all_rights' => 'Все права защищены'
    ),
    
    'posts' => array(
        'empty' => 'Нету постов',
        'published' => 'Опубликовано',
        'in_category' => 'в раздел',
        'by' => 'пользователем',
        'at' => 'в'
    ),
    
    'messages' => array(
        /**
         * Regular plain text messages
         */
        'required'   => 'Поле "%s" должно быть заполнено!',
        'min_length' => 'Длина поля "%s" должна быть больше чем или %s символов!',
        'max_length' => 'Длина поля "%s" должна быть меньше чем или %s символов!',
        'unique'     => 'Значение поля "%s" уже существует в БД!',
        'valid_mail' => 'Поле "%s" должно быть существующим электроным адресом почты!',
        'alpha_dash' => 'Поле "%s" должно сожержать латинские буквы, цифры, дефис и знак подчеркивания!',
        'html'       => 'Поле "%s" должно содержать только безопасные HTML тэги!',
        'no_html'    => 'Поле "%s" не должно содержать HTML тэги!',
        
        /**
         * Complex messages
         */
        'compare' => function ($field, $to) {
            $field_to = validation("fields.$to");
            $message  = 'Значение поля "%s" должно быть разным значению поле "%s"';
            
            $to = $field_to ? $field_to : $to;
            
            return sprintf($message, $field, $to);
        },
        
        'no_user' => 'Такого пользователя не существует или неверный пароль'
    ),
);