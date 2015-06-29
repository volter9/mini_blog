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
        <meta charset="utf-8"/>
        <title>Error - Exception was thrown</title>
    </head>
    
    <body>
        <h1>Error - Exception was thrown</h1>
        
        <?php echo $exception->getMessage() ?> 
        
        <p>Stack trace:</p>
            
        <ul>
            <?php foreach ($exception->getTrace() as $trace): ?> 
            <?php if (isset($trace['file'], $trace['line'])): ?> 
            <li>
                In 
                <code>
                    <?php echo exclude($trace['file'], MF_BASEPATH) ?> 
                </code> <br/>
                on line <?php echo $trace['line'] ?> 
            </li>
            <?php endif; ?> 
            <?php endforeach; ?> 
        </ul>
    </body>
</html>
