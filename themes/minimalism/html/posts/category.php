<?php
/**
 * Posts list view
 * 
 * @var array      $posts
 *      bool|array $posts['items'] - posts
 *      array      $posts['pages'] - pagination
 * @var string     $url
 */
?>
<article class="posts">
    <div class="post" data-component="category" data-id="<?php echo $category['id'] ?>">
        <h2 data-name="title"><?php echo $category['title'] ?></h2>
    
        <p data-name="description"><?php echo $category['description'] ?></p>
    </div>
    
    <?php if (!$posts['items']): ?> 
    <div class="post">
        <p><?php echo i18n('posts.empty') ?></p>
    </div>
    <?php else: ?> 
        <?php foreach ($posts['items'] as $post): ?> 
            <?php snippet('posts/snippet', $post) ?>
        <?php endforeach; ?> 
    <?php endif; ?> 
</article>

<?php if ($posts['pages']['pages'] > 1): ?> 
<div class="fluid"><?php 
    $pages = array_merge($posts['pages'], compact('url'));
    
    view('blocks/pagination', $pages, false); 
?></div>
<?php endif; ?> 
