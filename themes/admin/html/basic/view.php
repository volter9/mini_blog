<?php
/**
 * View page
 * 
 * @var string $header
 * @var string $module
 * @var array $data
 * @var array $pages
 */
?>
<article class="view view-<?php echo $module ?>">
    <h1 class="group">
        <?php echo $header ?> 
        
        <a class="button button-green"
           href="<?php echo url('#admin_add', array($module)) ?>">
            <?php echo lang('admin.common.add') ?> 
        </a>
    </h1>
    
    <?php if (!empty($data)): ?> 
    <?php view($template) ?> 
        
    <?php view('blocks/pagination', array_merge($pages, array(
        'url' => url('#admin_view', array($module))
    ))) ?> 
    <?php else: ?>
    <p><?php echo lang('admin.common.empty') ?></p>
    <?php endif; ?> 
</article>