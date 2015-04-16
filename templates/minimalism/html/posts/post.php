<?php
/**
 * Page display view
 * 
 * @var array $post
 */
?>
<article>
    <div class="post">  
        <div class="content">
            <h1>
                <?php echo $post['title'] ?> 
            </h1>
            
            <?php $parse = new Parsedown; echo $parse->text($post['text']) ?>
            
            <p class="info">
                <?php echo i18n('posts.published') ?> 
                <a href="<?php echo url('#category', array($post['category_url'])) ?>">
                    <?php echo $post['category'] ?> 
                </a> 
                <?php echo i18n('posts.by') ?> <?php echo $post['username'] ?> 
                <?php echo i18n('posts.at') ?> <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
            </p>
        </div>
    </div>
</article>
