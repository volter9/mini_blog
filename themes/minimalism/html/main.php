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
        <?php users('authorized') and view(module_path('admin', 'panel')) ?>
        
        <?php view('blocks/header') ?> 
        
        <div class="fluid" id="wrapper">
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
        
        <?php users('authorized') and view(module_path('admin', 'footer')) ?>
        <script src="<?php echo asset_url('js/hljs.js') ?>" type="text/javascript"></script>
        <script type="text/javascript">
            var pre = document.querySelectorAll('#wrapper pre');
            
            for (var i = 0, l = pre.length; i < l; ++i) {
                hljs.highlightBlock(pre[i]);
            }
        </script>
    </body>
</html>