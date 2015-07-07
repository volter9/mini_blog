<?php return function ($post) { ?>
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
        <a href="<?php echo url('#category', array($post['category_url'])) ?>"><?php 
            echo $post['category'] 
        ?></a> 
        | <?php endif; ?> <?php echo $post['username'] ?> 
        | <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
    </p>

    <p class="description" data-name="description">
        <?php echo $post['description'] ?>
    </p>
</div>
<?php } ?>