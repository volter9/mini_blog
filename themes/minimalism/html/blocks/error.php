<?php

$clip = function ($string, $limit = 50) {
    $length = mb_strlen($string);

    if ($length <= $limit) {
        return $string;
    }

    return '...' . substr($string, $length - $limit + 3);
};

?>
<div class="left">
    <?php echo $exception->getMessage() ?> 
</div>

<div class="right">
    <p>
        Stack trace (hover over path to get full path):
    </p>

    <ul>
        <?php foreach ($exception->getTrace() as $trace): ?> 
            <?php if (isset($trace['file'], $trace['line'])): ?> 
            <li>
                In file<br/>
                <code title="<?php echo exclude($trace['file'], MF_BASEPATH) ?>">
                    <?php echo $clip(exclude($trace['file'], MF_BASEPATH), 36) ?> 
                </code><br/>
                on line <?php echo $trace['line'] ?> 
            </li>
            <?php endif; ?> 
        <?php endforeach; ?> 
    </ul>
</div>
