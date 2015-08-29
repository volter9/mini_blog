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
    
    <body>
        <div id="wrapper">
        <?php view('blocks/header') ?> 
        
        <div class="fluid">
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
        </div>
    </body>
</html>