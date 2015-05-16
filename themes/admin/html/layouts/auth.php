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
        <link href="<?php echo asset_url('css/auth.css') ?>" 
              rel="stylesheet" 
              type="text/css"/>
    </head>
    
    <body>
        <h1>Форма входа</h1>
        
        <?php if ($errors = $data['error']): ?>
        <ul>
            <?php foreach ($errors as $error): ?> 
            <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        
        <?php build_form($scheme, $data) ?>
    </body>
</html>
