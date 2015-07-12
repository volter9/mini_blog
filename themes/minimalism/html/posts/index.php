<?php
/**
 * Posts list view
 * 
 * @var array      $posts
 *      bool|array $posts['items']      - posts
 *      array      $posts['pagination'] - pagination
 * @var string     $url
 */
?>
<article class="posts">
    <?php if (!$posts['items']): ?> 
    <div class="post empty">
        <p><?php echo i18n('posts.empty') ?></p>
    </div>
    <?php else: ?> 
        <?php foreach ($posts['items'] as $post): ?> 
            <?php snippet('snippets/posts', $post) ?>
        <?php endforeach; ?> 
    <?php endif; ?> 
</article>

<?php if ($posts['pages']['pages'] > 1): ?> 
<div class="fluid"><?php 
    $pages = array_merge($posts['pages'], compact('url'));
    
    view('blocks/pagination', $pages, false); 
?></div>
<?php endif; ?> 
