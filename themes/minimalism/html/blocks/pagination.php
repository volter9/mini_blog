<?php
/**
 * Pagination view
 * 
 * @var array $pagination
 * @var int $page
 * @var int $pages
 * @var int $limit
 * @var int $offset
 * @var string $url
 */
?>
<div class="pagination">
    <?php if ($page > 1): ?> 
    <!-- &#8592; is a left arrow unicode symbol -->
    <a class="button" href="<?php echo "$url/" . ($page - 1) ?>">&#8592;</a>
    <?php endif; ?> 
    
    <?php foreach ($pagination as $number): ?> 
        <?php if ($page !== $number): ?> 
        <a href="<?php echo "$url/$number" ?>"><?php echo $number ?></a>
        <?php else: ?> 
        <span><?php echo $number ?></span>
        <?php endif; ?> 
    <?php endforeach; ?> 
    
    <?php if ($page < $pages): ?> 
    <!-- &#8594; is a right arrow unicode symbol -->
    <a class="button" href="<?php echo "$url/" . ($page + 1) ?>">&#8594;</a>
    <?php endif; ?> 
</div>
