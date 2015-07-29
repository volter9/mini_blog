<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head', array('title' => '404 - Not Found')) ?> 
    </head>
    
    <body>
        <?php view('blocks/header') ?> 
        
        <article class="fluid error">
            <p>Sorry, this page wasn't found!</p>
        </article>
        
        <?php view('blocks/footer') ?> 
    </body>
</html>