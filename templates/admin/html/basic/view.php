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
    <h1 class="clearfix">
        <?php echo $header ?> 
        
        <a class="button green"
           href="<?php echo url('#admin_add', array($module)) ?>">
            <?php echo lang('admin.admin.add') ?> 
        </a>
    </h1>
    
    <?php if (!empty($data)): ?> 
    <div class="view">
        <?php view($template) ?> 
    </div>
    
    <?php view('blocks/pagination', array_merge($pages, array(
        'url' => url('#admin_view', array($module))
    ))) ?> 
    <?php else: ?> 
    <p><?php echo lang('admin.admin.empty') ?></p>
    <?php endif; ?> 
</article>