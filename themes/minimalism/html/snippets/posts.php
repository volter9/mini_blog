<?php return function ($post) { ?>
<div class="post" 
     data-component="post"
     data-id="<?php echo $post['id'] ?>">
    <ul class="info">
        <li> 
            <i class="fa fa-calendar"></i> 
            <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
        </li>
        <?php if (!empty($post['category'])): ?> 
        <li>
            <i class="fa fa-tag"></i> 
            <a href="<?php echo url('#category', array($post['category_url'])) ?>">
                <?php echo $post['category'] ?>
            </a>
        </li>
        <?php endif; ?> 
        <li>
            <i class="fa fa-user"></i> 
            <?php echo $post['username'] ?> 
        </li>
    </ul>
    
    <h2 class="post-title">
        <a href="<?php echo url('#post', array($post['url'])) ?>" data-name="title">
            <?php echo $post['title'] ?> 
        </a>
    </h2>

    <p class="description" data-name="description">
        <?php echo $post['description'] ?>
    </p>
    
    <div data-name="text">
        <?php $parse = new Parsedown; echo $parse->text($post['text']) ?> 
    </div>
</div>
<?php } ?>