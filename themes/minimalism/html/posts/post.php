<?php
/**
 * Page display view
 * 
 * @var array $post
 */
?>
<article>
    <div class="post" 
         data-component="post" 
         data-id="<?php echo $post['id'] ?>">  
        <h1 class="post-title" data-name="title">
            <?php echo $post['title'] ?> 
        </h1>
        
        <p class="info">
            <?php if (!empty($post['category'])): ?>
            <a href="<?php echo url('#category', array($post['category_url'])) ?>">
                <?php echo $post['category'] ?> 
            </a> 
            | <?php endif; ?> 
            <span data-name="username">
                <?php echo $post['username'] ?> 
            </span>
            | <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
        </p>
        
        <div data-name="text">
            <?php $parse = new Parsedown; echo $parse->text($post['text']) ?> 
        </div>
    </div>
</article>
