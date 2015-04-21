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
        
        <link href="<?php echo asset_path('css/admin.css') ?>" 
              rel="stylesheet" 
              type="text/css"/>
    </head>
    
    <body>
        <?php view('blocks/header') ?> 

        <div id="content">
            <?php view($view) ?> 

            <?php view('blocks/footer') ?> 
        </div>
    </body>
</html>