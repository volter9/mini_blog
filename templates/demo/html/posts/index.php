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

<!-- Выводим пагинацию -->
<?php view('admin:blocks/pagination', array_merge(
    $posts['pages'], ['url' => $url]
), false) ?>