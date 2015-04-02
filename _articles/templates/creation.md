---
layout: post
title: Создание темы
permalink: /articles/templates/creation/
---
Все что нужно для темы в данной версии (v1.0), это пару шаблонов:

* `html/main.php` – главный макет темы
* `html/posts/index.php` – отоброжение записей и пагинации
* `html/posts/post.php` – отоброжение одной записи

## Создаем макет

Создайте папку `demo` в папке `templates`.

Теперь нужно создать макет. Макет (`html/main.php`) это основа для темы. Макет должен содержать основу, т.е. DOCTYPE, html, head, body и отображение данного шаблона (имя которого содержится в переменной `$view`). Пример:

{% highlight html+php %}
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
    </head>
    
    <body>
        <?php view($view) ?>
    </body>
</html>
{% endhighlight %}

Для каждого шаблона передается две переменных: `$title` и `$view`. 

Переменная `$title` содержит в себе заголовок данной страницы. Переменная `$view` содержит в себе путь к шаблону для данной страницы.

Функция `view($view)` отобразит шаблон в данной теме.

## Отображаем записи 

Есть два шаблона которые надо создать для отображения записи и записей, `html/posts/index.php` и `html/posts/page.php`.

В шаблоне `html/posts/index.php` доступны две переменных: `$url` и `$posts`.

Переменная `$url` нужна для пагинации, а переменная `$posts` содержит два элемента: `pages` - информация о пагинации и `items` - сами записи. `$posts['items']` может содержать массив записей или `false` (если не существует записей по данному запросу). Простой пример:

{% highlight html+php %}
<!-- Если записи существуют -->
<?php if ($posts['items']): ?> 
    <ul class="posts">
        <!-- Проходимся через массив с записями -->
        <?php foreach ($posts['items'] as $post): ?> 
        <li class="post">
            <h3>
                <!-- Ссылка на пост -->
                <a href="<?php echo url('#post', [$post['url']]) ?>">
                <?php echo $post['title'] ?>
                </a>
            </h3>
        
            <?php echo $post['description'] ?>
        </li>
        <?php endforeach; ?> 
    </ul>
<?php else: ?> 
    <p>Нету постов :(</p>
<?php endif; ?> 

<!-- Выводим пагинацию, пагинация находится в шаблоне admin -->
<?php view('admin:blocks/pagination', array_merge(
    $posts['pages'], ['url' => $url]
), false) ?> 
{% endhighlight %}

Данный кусок кода выведет записи (если они существуют) и пагинацию.
`url('#post', [$post['url']])` – кусок кода создает URL на страницу записи.

Шаблон с выводом записью (`html/posts/page.php`) имеет всего одну переменную: `$post`.
Переменная `$post` содержит в себе информацию о записи.
Простой пример шаблона:

{% highlight html+php %}
<!-- Заголовок статьи -->
<h1><?php echo $post['title'] ?></h1>

<blockquote>
<?php echo $post['category'] ?> |
<?php echo $post['date'] ?> |
<?php echo $post['username'] ?>
</blockquote>

<!-- Преобразуем markdown в HTML -->
<?php echo (new Parsedown)->text($post['text']) ?>
{% endhighlight %}

`(new Parsedown)->text($post['text'])` преобразует [markdown](https://ru.wikipedia.org/wiki/Markdown) в HTML, ну а `echo`, конечно же выводит.

Теперь у нас есть простая тема. Энжой :)

**Внимание**: данная инструкция написана для mini_blog v1.0

Также, данная тема (которую мы только что создали) доступна [в репозитории](https://github.com/Volter9/mini_blog/tree/master/templates/demo).