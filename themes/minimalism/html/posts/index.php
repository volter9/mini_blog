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
    <div class="post">
        <p><?php echo i18n('posts.empty') ?></p>
    </div>
    <?php else: ?> 
        <?php foreach ($posts['items'] as $post): ?> 
            <?php snippet('posts/snippet', $post) ?>
        <?php endforeach; ?> 
        
        <div class="fluid"><?php 
            $pages = array_merge($posts['pages'], compact('url'));
            
            view('blocks/pagination', $pages, false); 
        ?></div>
    <?php endif; ?> 
</article>
