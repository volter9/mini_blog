<?php return function ($post) { ?> 
<div class="post" 
     data-component="post"
     data-id="<?php echo $post['id'] ?>">
    <h2 class="post-title">
        <?php if (isset($post['url'])): ?> 
        <a href="<?php echo url('#post', array($post['url'])) ?>" data-name="title">
            <?php echo $post['title'] ?> 
        </a>
        <?php else: ?> 
        <span data-name="title">
            <?php echo $post['title'] ?> 
        </span>
        <?php endif; ?>  
    </h2>

    <p class="description" data-name="description">
        <?php echo $post['description'] ?> 
    </p>
    
    <div data-name="text">
        <?php echo $post['text'] ?> 
    </div>
    
    <ul class="info">
        <li> 
            <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
        </li>
        <li>
            <?php if (!empty($post['category'])): ?> 
            <a href="<?php echo url('#category', array($post['category_url'])) ?>">
                <?php echo $post['category'] ?> 
            </a>
            <?php else: ?>
            <a href="<?php echo url('#posts') ?>">Без категории</a>
            <?php endif; ?> 
        </li>
    </ul>
</div>
<?php } ?>