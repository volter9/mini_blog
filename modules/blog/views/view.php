<?php
/**
 * Posts view
 * 
 * @var array $data
 */
?>
<ul class="posts group">
    <?php foreach ($data as $post): ?> 
    <li class="left">
        <div class="header group">
            <div class="left">
                <a href="<?php echo url('#admin_edit', array($module, $post['id'])) ?>">
                    <?php echo $post['title'] ?>
                </a>
            </div>
            
            <div class="right edit">
                <a class="button button-blue" 
                   href="<?php echo url('#admin_edit', array($module, $post['id'])) ?>">
                    <?php echo lang('admin.common.edit') ?> 
                </a>
                
                <a class="button button-red" 
                   href="<?php echo url('#admin_remove', array($module, $post['id'])) ?>">
                   <?php echo lang('admin.common.remove') ?> 
                </a>
            </div>
        </div>
        
        <p class="date">
            <?php echo date('d.m.Y', strtotime($post['date'])) ?>
        </p>
        
        <p class="description"><?php echo $post['description'] ?></p>
    </li>
    <?php endforeach; ?> 
</ul>