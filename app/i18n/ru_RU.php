<?php 

return [
    'header' => [
        'title' => 'mini_blog',
        'home'  => 'Домой',
        'admin' => 'Админка'
    ],
    
    'footer' => [
        'all_rights' => 'Все права защищены'
    ],
    
    'messages' => [
        /**
         * Regular plain text messages
         */
        'required'   => 'Поле "%s" должно быть заполнено!',
        'min_length' => 'Длина поля "%s" должна быть больше чем или %s символов!',
        'max_length' => 'Длина поля "%s" должна быть меньше чем или %s символов!',
        'unique'     => 'Значение поля "%s" уже существует в БД!',
        'valid_mail' => 'Поле "%s" должно быть существующим электроным адресом почты!',
        'alpha_dash' => 'Поле "%s" должно сожержать латинские буквы, цифры, дефис и знак подчеркивания!',
        
        /**
         * Complex messages
         */
        'compare' => function ($field, $to) {
            $to = validation("fields.$to") ?: $to;
            
            return sprintf('Значение поля "%s" должно быть разным значению поле "%s"', $field, $to);
        }
    ],
];