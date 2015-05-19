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
<article class="view view-templates">
    <h1><?php echo $header ?></h1>
    
    <p><?php echo lang('admin.templates.description') ?></p>
    
    <?php if (!empty($data)): ?> 
        <?php view(module_path('templates', 'views/view')) ?> 
    <?php else: ?> 
    <p><?php echo lang('admin.common.empty') ?></p>
    <?php endif; ?> 
</article>