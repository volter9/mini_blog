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
                <?php echo $post['title'] ?>
            </div>
            
            <div class="right edit">
                <a class="edit" 
                   href="<?php echo url('#admin_edit', array($module, $post['id'])) ?>">&#9998;</a> 
                <a class="remove" 
                   href="<?php echo url('#admin_remove', array($module, $post['id'])) ?>">&#10005;</a>
            </div>
        </div>
        
        <p class="description"><?php echo $post['description'] ?></p>
    </li>
    <?php endforeach; ?> 
</ul>