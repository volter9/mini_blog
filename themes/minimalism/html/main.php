<?php 
/**
 * Main layout
 * 
 * @var string $title
 * @var string $view
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?> 
    </head>
    
    <body data-baseurl="<?php echo router('settings.root') ?>"
          data-lang="<?php echo lang('settings.default') ?>">
        <?php view(module_path('admin', 'panel')) ?>
        
        <?php view('blocks/header') ?> 
        
        <div class="fluid" id="wrapper">
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
        
        <script src="<?php echo asset_url('js/hljs.js') ?>"
                type="text/javascript"></script>
        <script src="<?php echo module_url('admin', 'js/mini_blog.js') ?>" 
                type="text/javascript"></script>
        <?php foreach (admin_scripts() as $script): ?>
        <script src="<?php echo $script ?>"
                type="text/javascript"></script>
        <?php endforeach; ?>
        <script type="text/javascript">
            mini_blog.init();
            mini_blog.toArray(document.querySelectorAll('#wrapper pre'))
                     .forEach(hljs.highlightBlock);
        </script>
    </body>
</html>