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
            <h1 class="post-title">
                <?php echo $post['title'] ?> 
            </h1>
            
            <p class="info">
                <?php if (!empty($post['category'])): ?>
                <a href="<?php echo url('#category', array($post['category_url'])) ?>">
                    <?php echo $post['category'] ?> 
                </a> 
                |<?php endif; ?> <?php echo $post['username'] ?> 
                | <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
            </p>
            
            <?php $parse = new Parsedown; echo $parse->text($post['text']) ?> 
        </div>
    </div>
</article>
