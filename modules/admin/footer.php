<?php foreach (admin_scripts() as $script): ?>
<script src="<?php echo $script ?>"
        type="text/javascript"></script>
<?php endforeach; ?>
<script type="text/javascript">
    mini_blog.init();
    mini_blog.toArray(document.querySelectorAll('#wrapper pre'))
             .forEach(hljs.highlightBlock);
</script>
