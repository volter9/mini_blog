<?php
/**
 * Posts view
 * 
 * @var array $data
 */
?>
<ul class="posts clearfix">
    <?php foreach ($data as $post): ?> 
    <li>
        <section>
            <div class="header clearfix">
                <div class="left">
                    <a href="<?php echo url('#post', [$post['url']]) ?>">
                        <?php echo $post['title'] ?> 
                    </a>
                </div>
                
                <a class="right button blue" 
                   href="<?php echo url('#admin_edit', array($module, $post['id'])) ?>">
                    <?php echo lang('admin.admin.edit') ?> 
                </a>
            </div>
            
            <p><?php echo mb_substr($post['description'], 0, 120) ?>...</p>
        </section>
    </li>
    <?php endforeach; ?> 
</ul>