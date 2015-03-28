<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?>
        <link href="<?php echo template_path('css/auth.css') ?>" rel="stylesheet" type="text/css"/>
    </head>
    
    <body class="auth">
        <section class="wrapper">
            <h1>mini_blog</h1>
            
            <?php build_form($scheme, $data) ?> 
            
            <p>
                <a href="<?php echo url('#index') ?>">
                    <span>&#8592; go back</span>
                </a>
            </p>
        </section>
        
        <?php view('blocks/footer') ?>
    </body>
</html>