<article class="posts">
    <?php if (!$posts['items']): ?> 
        <p>No posts</p>
    <?php else: ?>
        <?php foreach ($posts['items'] as $post): ?> 
            <div class="post">
                <div class="content">
                    <h2>
                        <a href="<?php echo url('#post', $post['url']) ?>">
                            <?php echo $post['title'] ?> 
                        </a>
                    </h2>
                    
                    <p class="info">
                        Posted in 
                        <a href="<?php echo url('#category', [$post['category_url']]) ?>">
                            <?php echo $post['category'] ?> 
                        </a> 
                        by <?php echo $post['username'] ?> 
                        at <?php echo date('d.m.Y', strtotime($post['date'])) ?> 
                    </p>
                
                    <p class="description">
                        <?php echo $post['description'] ?> 
                    </p>
                </div>
            </div>
        <?php endforeach; ?> 
        
        <?php view('admin:blocks/pagination', array_merge(
            $posts['pages'], ['url' => $url]
        ), false) ?> 
    <?php endif; ?> 
</article>
