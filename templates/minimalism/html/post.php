<article class="post">
    <div class="post">  
        <div class="content">
            <h1>
                <?php echo $post['title'] ?> 
            </h1>
            
            <p class="info">
                Posted in 
                <a href="<?php echo url('#category', [$post['category_url']]) ?>">
                    <?php echo $post['category'] ?> 
                </a> 
                by <?php echo $post['username'] ?> 
                at <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
            </p>
            
            <?php $parse = new Parsedown; echo $parse->text($post['text']) ?>
        </div>
    </div>
</article>
