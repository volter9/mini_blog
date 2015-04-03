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
        <title>Error - Exception was thrown</title>
        <link href="<?php echo template_path('css/main.css') ?>" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
        <?php view('blocks/header') ?>
        
        <article class="error">
            <div class="left">
                <?php echo $exception->getMessage() ?>
            </div>
            
            <div class="right">
                <p>Stack trace:</p>
            
                <ul>
                    <?php foreach ($exception->getTrace() as $trace): ?>
                        <?php if (isset($trace['file'], $trace['line'])): ?>
                        <li>
                            In <code>/<?php echo exclude(MF_BASEPATH, $trace['file']) ?></code> 
                            on line <?php echo $trace['line'] ?>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </article>
    </body>
</html>