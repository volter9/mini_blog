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
        
        <?php emit('admin:head') ?> 
    </head>
    
    <body>
        <?php view('blocks/header') ?> 

        <div class="wrapper group" id="wrapper">
            <div class="left width-80" id="content">
                <?php view($view) ?> 
            </div>
            
            <div class="right width-20" id="sidebar">
                <?php view('blocks/menu') ?> 
            </div>
        </div>
        
        <?php view('blocks/footer') ?> 
    </body>
</html>
