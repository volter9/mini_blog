<?php
/**
 * Auth form page
 * 
 * @var string $title
 * @var array $scheme
 * @var array $data
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?>
        <link href="<?php echo asset_path('css/auth.css') ?>" 
              rel="stylesheet" 
              type="text/css"/>
    </head>
    
    <body class="auth">
        <section class="wrapper">
            <h1>mini_blog</h1>
            
            <div id="auth_form">
                <?php if ($error): ?>
                <div class="errors">
                    <p><?php echo $error ?></p>
                </div>
                <?php endif; ?>
                
                <?php build_form($scheme, $data) ?> 
            </div>
            
            <p>
                <a href="<?php echo url('#index') ?>">
                    <span>&#8592; <?php echo lang('admin.admin.go_back') ?></span>
                </a>
            </p>
        </section>
    </body>
</html>