<?php foreach (admin_scripts() as $script): ?>
<script src="<?php echo $script ?>" type="text/javascript"></script>
<?php endforeach; ?>
<script type="text/javascript">
window.addEventListener('load', function () {
    bootstraping.forEach(function (callback) {
        callback();
    });
    
    mini_blog.lang(<?php echo json(lang('app')) ?>);
    mini_blog.init(<?php echo json(array(
        'baseurl' => router('settings.root'),
        'lang'    => lang('settings.default')
    )) ?>);
});
</script>
