<?php
/**
 * Error page
 * 
 * @var \Exception $exception
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head', array('title' => 'Error - Exception was thrown')) ?> 
    </head>
    
    <body>
        <div id="wrapper">
        <?php view('blocks/header') ?> 
        
        <article class="fluid clearfix error">
            <?php view('blocks/error') ?> 
        </article>
        
        <?php view('blocks/footer') ?> 
        </div>
    </body>
</html>
