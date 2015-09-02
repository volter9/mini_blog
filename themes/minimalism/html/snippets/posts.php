<?php return function ($post) { 
    $category_url = !empty($post['category_url']) ? $post['category_url'] : '';
    ?> 
<div class="post" 
     data-component="post"
     data-id="<?php echo $post['id'] ?>">
    <h2 class="post-title">
        <a class="post-title"
           href="<?php echo url('#post', array($post['url'])) ?>" 
           data-name="title"
           data-type="input">
            <?php echo $post['title'] ?> 
        </a>
    </h2>
    
    <div class="text"
         data-name="text"
         data-type="text">
<?php echo $post['text'] ?> 
    </div>
    
    <ul class="info">
        <li> 
            <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
        </li>
        <li data-name="category">
            <?php if ($category_url): ?> 
            <a href="<?php echo url('#category', array($category_url)) ?>">
                <?php echo $post['category'] ?> 
            </a>
            <?php endif; ?> 
        </li>
    </ul>
</div>
<?php } ?>