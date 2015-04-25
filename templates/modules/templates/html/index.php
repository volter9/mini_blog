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
<article class="view templates">
    <h1 class="clearfix">
        <?php echo $header ?> 
    </h1>
    
    <?php if (!empty($data)): ?> 
    <div class="columns">
        <div class="left">
            <?php view('modules/templates:view') ?> 
        </div>
    </div>
    <?php else: ?>
    <p><?php echo lang('admin.admin.empty') ?></p>
    <?php endif; ?> 
</article>