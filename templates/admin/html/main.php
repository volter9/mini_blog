<?php
/**
 * Main admin layout
 * 
 * @var string $view
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?> 
        <link href="<?php echo asset_url('css/admin.css') ?>" 
              rel="stylesheet" 
              type="text/css"/>
        <link href="<?php echo asset_url('css/font-awesome.min.css') ?>" 
              rel="stylesheet" 
              type="text/css"/>
        
        <?php emit('admin:head') ?> 
    </head>
    
    <body>
        <?php view('blocks/header') ?> 

        <div id="content">
            <?php view($view) ?> 

            <?php view('blocks/footer') ?> 
        </div>
    </body>
</html>