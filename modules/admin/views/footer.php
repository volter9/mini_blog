<?php foreach (admin_scripts() as $script): ?>
<script src="<?php echo $script ?>" type="text/javascript"></script>
<?php endforeach; ?>
<script type="text/javascript">
    window.addEventListener('load', function () {
        mini_blog.init(<?php echo json_encode(array(
            'baseurl' => router('settings.root'),
            'lang'    => lang('settings.default')
        )) ?>);
    });
</script>
