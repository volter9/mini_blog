<?php
/**
 * Error page
 * 
 * @var \Exception $exception
 */

if (!function_exists('str_clip')) {
    function str_clip ($string, $limit = 50) {
        $length = mb_strlen($string);

        if ($length <= $limit) {
            return $string;
        }

        return '...' . substr($string, $length - $limit + 3);
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Error - Exception was thrown</title>
        <link href="<?php echo asset_url('css/styles.css') ?>" 
              rel="stylesheet" 
              type="text/css"/>
    </head>
    
    <body>
        <?php view('blocks/header') ?> 
        
        <article class="fluid clearfix error">
            <div class="left">
                <?php echo $exception->getMessage() ?> 
            </div>
            
            <div class="right">
                <p>Stack trace (hover over path to get full path):</p>
            
                <ul>
                    <?php foreach ($exception->getTrace() as $trace): ?> 
                        <?php if (isset($trace['file'], $trace['line'])): ?> 
                        <li>
                            In file<br/>
                            <code title="<?php echo exclude($trace['file'], MF_BASEPATH) ?>"><?php 
                                echo str_clip(exclude($trace['file'], MF_BASEPATH), 36) 
                            ?></code><br/>
                            on line <?php echo $trace['line'] ?> 
                        </li>
                        <?php endif; ?> 
                    <?php endforeach; ?> 
                </ul>
            </div>
        </article>
    </body>
</html>