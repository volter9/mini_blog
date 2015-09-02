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
    <a class="button" href="<?php echo deduplicate("$url" . ($page - 1), '/') ?>">
        &#8592;
    </a>
    <?php endif; foreach ($pagination as $number): if ($page !== $number): ?> 
    <a href="<?php echo deduplicate("$url$number", '/') ?>">
        <?php echo $number ?> 
    </a>
    <?php else: ?> 
    <span>
        <?php echo $number ?> 
    </span>
    <?php endif; endforeach; if ($page < $pages): ?> 
    <a class="button" href="<?php echo deduplicate("$url" . ($page + 1), '/') ?>">
        &#8594;
    </a><?php endif ?> 
</div>
