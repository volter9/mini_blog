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
        
        <div class="right">
            <a class="button green"
               href="<?php echo url('#admin_add', array($module)) ?>">
                <?php echo lang('admin.admin.add') ?> 
            </a>
        </div>
    </h1>
    
    <?php if (!empty($data)): ?> 
    <div class="columns">
        <div class="left">
            <?php view($template) ?> 
            
            <?php view('blocks/pagination', array_merge($pages, array(
                'url' => url('#admin_view', array($module))
            ))) ?> 
        </div>
    </div>
    <?php else: ?>
    <p><?php echo lang('admin.admin.empty') ?></p>
    <?php endif; ?> 
</article>