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
        <div class="post" 
             data-component="post"
             data-id="<?php echo $post['id'] ?>">
            <h2 class="post-title">
                <a href="<?php echo url('#post', array($post['url'])) ?>" data-name="title">
                    <?php echo $post['title'] ?> 
                </a>
            </h2>
            
            <p class="info">
                <?php if (!empty($post['category'])): ?>
                <a href="<?php echo url('#category', array($post['category_url'])) ?>">
                    <?php echo $post['category'] ?> 
                </a> 
                | <?php endif; ?> <?php echo $post['username'] ?> 
                | <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
            </p>
        
            <p class="description" data-name="description">
                <?php echo $post['description'] ?>
            </p>
        </div>
        <?php endforeach; ?> 
        
        <div class="fluid">
        <?php 
            $pages = array_merge($posts['pages'], compact('url'));
            
            view('blocks/pagination', $pages, false); 
        ?> 
        </div>
    <?php endif; ?> 
</article>
