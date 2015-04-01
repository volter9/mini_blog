---
layout: post
title: Установка
permalink: /articles/install/
---
Есть несколько способов установить mini_blog:

## Установить через composer

Установите [composer](https://getcomposer.org/doc/00-intro.md), если у Вас его нету. И следуйте инструкции:

1. Скачиваете архив [данного репозиторий](https://github.com/Volter9/mini_blog) и распаковываете его там где хотите установить mini_blog (на веб сервере с поддержкой PHP, конечно же)
2. Открываете терминал и переходите в папку в которой вы распаковали архив
3. Запускаете комманду `composer install` 
4. Заливаете дамп базы данных (`mini_blog.sql`)
5. Правите файл конфигурации (`app/config.php`) и устанавливаете данные о соеденения к MySQL базы данных:
{% highlight php %}
<?php /* app/config.php */

return [
    'database' => [
        'autoload' => true,
        'default' => [
            'host'     => 'localhost', // хост
            'user'     => 'root',      // пользователь
            'name'     => 'mini_blog', // база данных
            'password' => '',          // пароль
            'charset'  => 'utf8'
        ]
    ],
    /* ... */
];
{% endhighlight %}

## Установить готовую версию

Также можно установить mini_blog без использования composer. Все что надо сделать:

1. Скачать готовый [архив с mini_blog](https://github.com/Volter9/mini_blog/releases/download/1.0/mini_blog.zip)
2. Повторить пукты 3 и 4 из секции "Установить через composer"

## Установить инсталятор

> @todo Данный способ планируется в следующей версии