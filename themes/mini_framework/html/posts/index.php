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
<div class="wrapper">
    <article class="fluid posts">
        <?php if ($posts['items']): ?> 
            <?php foreach ($posts['items'] as $post): ?> 
            <div class="post">
                <h2>
                    <a href="<?php echo url('#post', array($post['url'])) ?>">
                        <?php echo $post['title'] ?> 
                    </a>
                    
                    <div class="right">
                        <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
                    </div>
                </h2>
        
                <p class="description">
                    <?php $parse = new Parsedown; echo $parse->text($post['text']) ?> 
                </p>
            </div>
            <?php endforeach; ?> 
            
            <?php view('admin:blocks/pagination', array_merge(
                $posts['pages'], array('url' => $url)
            ), false) ?> 
        <?php else: ?> 
        <div class="post">
            <p><?php echo i18n('posts.empty') ?></p>
        </div>
        <?php endif; ?> 
    </article>
</div>