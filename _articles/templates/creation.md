---
layout: post
title: Создание темы
permalink: /articles/templates/creation/
---
Все что нужно для шаблона в данной версии, это пару шаблонов:

* `html/main.php` – главный макет темы
* `html/posts/index.php` – отоброжение записей и пагинации
* `html/posts/post.php` – отоброжение одной записи

## Создаем макет

Перед тем как начать создавать шаблон, Вы должны иметь **базовые знания** HTML и PHP.

Создайте папку `demo` в папке `templates`.

Теперь нужно создать макет. Макет (`html/main.php`) это основа для темы. Макет должен содержать основу, т.е. DOCTYPE, html, head, body и отображение данного шаблона (в переменной `$view`). Простой пример:

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

Для каждого шаблона передается две обязательных переменных: `$title` и `$view`. 

Переменная `$title` содержит в себе заголовок данного представления и переменная `$view` содержит в себе шаблон для данного шаблона.

Функция `view()` отображает шаблон в данной теме оформление.

## Отображаем записи 

Есть два шаблона которые надо создать для отображения записи и записей, `html/posts/index.php` и `html/posts/page.php`.

В шаблоне `html/posts/index.php` доступны две переменных: `$url` и `$posts`.

Переменная `$url` нужна для пагинации, а переменная `$posts` содержит два элемента: `pages` - информация о пагинации и `items` - сами записи. `$posts['items']` может содержать запили или `false` (если не существует записей по данному запросу). Простой пример:

{% highlight html+php %}
<!-- Если записи существуют -->
<?php if ($posts['items']): ?> 
    <ul class="posts">
        <!-- Проходимся через массив с записями -->
        <?php foreach ($posts['items'] as $post): ?> 
        <li class="post">
            <h3><?php echo $post['title'] ?></h3>
        
            <?php echo $post['description'] ?>
        </li>
        <?php endforeach; ?> 
    </ul>
<?php else: ?> 
    <p>Нету постов :(</p>
<?php endif; ?> 

<!-- Выводим пагинацию -->
<?php view('admin:blocks/pagination', array_merge(
    $posts['pages'], ['url' => $url]
), false) ?> 
{% endhighlight %}

Данный кусок кода выведет записи (если они существуют) и пагинацию (если записи существуют).

Шаблон с выводом записью (`html/posts/page.php`) имеет всего одну переменную: `$post`.
Переменная `$post` содержит в себе информацию о записи.
Простой пример шаблона:

{% highlight html+php %}
<!-- Заголовок статьи -->
<h1><?php echo $post['title'] ?></h1>

<blockquote><?php echo $post['category'] ?> |
<?php echo $post['date'] ?> |
<?php echo $post['username'] ?>
</blockquote>

<?php echo $post['text'] ?>
{% endhighlight %}

Теперь у нас есть простая тема.

**Внимание**: данная инструкция написаны для mini_blog v1.0
