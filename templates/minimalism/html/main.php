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
        <?php view('blocks/header') ?> 
        
        <div class="fluid" id="wrapper">
            <?php view('blocks/navigation') ?> 
            
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
    </body>
</html>