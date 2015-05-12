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
        <?php view(module_path('templates', 'views/view')) ?> 
    <?php else: ?> 
    <p><?php echo lang('admin.admin.empty') ?></p>
    <?php endif; ?> 
</article>