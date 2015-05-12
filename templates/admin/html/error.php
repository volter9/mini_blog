<?php 
/**
 * Exception view
 * 
 * @var \Exception $exception
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Error - Exception was thrown</title>
        <link href="<?php echo asset_url('css/error.css') ?>" rel="stylesheet" type="text/css"/>
    </head>
    
    <body>
        <?php view('blocks/header') ?> 
        
        <article class="error clearfix fluid">
            <div class="left">
                <?php echo $exception->getMessage() ?> 
            </div>
            
            <div class="right">
                <p>Stack trace:</p>
            
                <ul>
                    <?php foreach ($exception->getTrace() as $trace): ?> 
                        <?php if (isset($trace['file'], $trace['line'])): ?> 
                        <li>
                            In <code><?php echo $trace['file'] ?></code> <br/>
                            on line <?php echo $trace['line'] ?> 
                        </li>
                        <?php endif; ?> 
                    <?php endforeach; ?> 
                </ul>
            </div>
        </article>
    </body>
</html>