<?php
/**
 * Auth form page
 * 
 * @var array $scheme
 * @var array $data
 */
?>
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
                    <span>&#8592; <?php echo lang('admin.admin.go_back') ?></span>
                </a>
            </p>
        </section>
    </body>
</html>