<?php
/**
 * Modify a module entry
 * 
 * @var string $header
 * @var string $module
 * @var bool $edit
 * @var array $scheme
 * @var array $data
 */
?>
<article class="modify modify-<?php echo $module ?>">
    <h1 class="clearfix"><?php echo $header ?></h1>
    
    <?php build_form($scheme, $data) ?> 
</article>