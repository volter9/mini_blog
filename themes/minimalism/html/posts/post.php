<?php
/**
 * Page display view
 * 
 * @var array $post
 */
?>
<article>
    <?php snippet('snippets/posts', $post) ?> 
</article>
<?php if (users('authorized')): ?>
<script type="text/javascript">
    bootstraping.push(function () {
        mini_blog.posts.collection.bootstrap([<?php 
            echo json($post) 
        ?>]);
    });
</script>
<?php endif; ?> 