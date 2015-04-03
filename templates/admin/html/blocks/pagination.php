<?php
/**
 * Pagination view
 * 
 * @var array $pagination
 * @var int $page
 * @var int $pages
 * @var int $limit
 * @var int $offset
 */
?>
<?php if (!empty($pagination)): ?> 
<div class="pagination">
    <?php if ($page > 1): ?> 
    <a class="button" href="<?php echo "$url/" . ($page - 1) ?>">&#8592;</a>
    <?php endif; ?> 
    
    <?php foreach ($pagination as $number): ?> 
        <?php if ($page !== $number): ?> 
        <a class="button" href="<?php echo "$url/$number" ?>"><?php echo $number ?></a>
        <?php else: ?> 
        <span class="button disabled"><?php echo $number ?></span>
        <?php endif; ?> 
    <?php endforeach; ?> 
    
    <?php if ($page < $pages): ?> 
    <a class="button" href="<?php echo "$url/" . ($page + 1) ?>">&#8594;</a>
    <?php endif; ?> 
</div>
<?php endif; ?> 
