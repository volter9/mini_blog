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
        
        <link href="<?php echo template_path('css/admin.css') ?>" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
<?php view('blocks/header') ?> 

<?php view($view) ?> 

<?php view('blocks/footer') ?> 
    </body>
</html>