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
        <section id="wrapper">
            <div class="form-wrapper">
                <h1 id="mini_blog">mini_blog</h1>
                
                <?php if (isset($data['error']) && $errors = $data['error']): ?> 
                <div class="alert red-alert">
                    <?php foreach ($errors as $error): ?> 
                    <p><?php echo $error ?></p>
                    <?php endforeach; ?> 
                </div>
                <?php endif; ?> 
                
                <?php build_form($scheme, $data) ?>
            </div>
        </section>
    </body>
</html>
