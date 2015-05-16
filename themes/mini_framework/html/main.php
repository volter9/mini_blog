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
        
        <?php view($view) ?> 
        
        <?php view('blocks/footer') ?> 
    </body>
</html>