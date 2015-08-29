<?php return function ($post) { 
    $category_url = !empty($post['category_url']) ? $post['category_url'] : '';
    ?> 
<div class="post" 
     data-component="post"
     data-id="<?php echo $post['id'] ?>">
    <h2 class="post-title">
        <?php if (isset($post['url'])): ?> 
        <a href="<?php echo url('#post', array($post['url'])) ?>" 
           data-name="title"
           data-type="input">
            <?php echo $post['title'] ?> 
        </a>
        <?php else: ?> 
        <span data-name="title"
              data-type="input">
            <?php echo $post['title'] ?> 
        </span>
        <?php endif; ?>  
    </h2>

    <p class="description" data-name="description">
        <?php echo $post['description'] ?> 
    </p>
    
    <p class="url" 
       data-name="url"
       data-type="input">
        <?php echo $post['url'] ?>
    </p>
    
    <div class="text"
         data-name="text"
         data-type="text">
        <?php echo $post['text'] ?> 
    </div>
    
    <ul class="info">
        <li> 
            <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
        </li>
        <li>
            <a href="<?php echo url('#category', array($category_url)) ?>">
            <?php if ($category_url): ?> 
                <?php echo $post['category'] ?> 
            <?php endif; ?> 
            </a>
        </li>
    </ul>
</div>
<?php } ?>