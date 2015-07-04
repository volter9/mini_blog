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
    
    <body data-baseurl="<?php echo router('settings.root') ?>">
        <?php view('blocks/header') ?> 
        
        <div class="fluid" id="wrapper">
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
        
        <div class="hidden" id="mini_editor"></div>
        
        <script src="<?php echo module_url('admin', 'js/mini_blog.js') ?>" 
                type="text/javascript"></script>
        <script src="<?php echo asset_url('js/hljs.js') ?>"
                type="text/javascript"></script>
        <script type="text/javascript">
            mini_blog.init();
            
            hljs.initHighlightingOnLoad();
        </script>
    </body>
</html>