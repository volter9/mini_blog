<article class="settings">
    <h1 class="clearfix">
        <?php echo lang('admin.settings.title') ?> 
    </h1>
    
    <?php if (isset($subheader) && $subheader): ?>
    <h3><?php echo $subheader ?></h3>
    <?php endif; ?>
    
    <?php build_form($scheme, $data) ?> 
</article>