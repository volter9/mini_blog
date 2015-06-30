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
        
        <div id="wrapper">
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
        
        <script src="<?php echo module_url('admin', 'js/mini_blog.js') ?>" 
                type="text/javascript"></script>
    </body>
</html>