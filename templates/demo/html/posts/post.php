<!-- Заголовок статьи -->
<h1><?php echo $post['title'] ?></h1>

<blockquote><?php echo $post['category'] ?> |
<?php echo $post['date'] ?> |
<?php echo $post['username'] ?>
</blockquote>

<?php echo (new Parsedown)->text($post['text']) ?>