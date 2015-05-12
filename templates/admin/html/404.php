<!DOCTYPE html>
<html>
    <head>
        <title>404 - Not Found</title>
        <link href="<?php echo asset_url('css/error.css') ?>" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
        <?php view('blocks/header') ?> 
        
        <article class="error">
            <h1>404 Not Found</h1>
            
            <p>Sorry, this page wasn't found!</p>
        </article>
        
        <?php view('blocks/footer') ?> 
    </body>
</html>