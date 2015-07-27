<?php foreach (admin_scripts() as $script): ?>
<script src="<?php echo $script ?>" type="text/javascript"></script>
<?php endforeach; ?>
<script type="text/javascript">
    window.addEventListener('load', function () {
        mini_blog.settings.collection.bootstrap(<?php 
            echo json_encode(storage('settings'), JSON_UNESCAPED_UNICODE) 
        ?>);
        
        <?php if (isset($posts, $post)): ?> 
        mini_blog.posts.collection.bootstrap(<?php 
            echo json_encode($posts['items']) 
        ?>);<?php elseif (isset($post)): ?> 
        mini_blog.posts.collection.bootstrap([<?php 
            echo json_encode($post, JSON_UNESCAPED_UNICODE) 
        ?>]);
        <?php endif; ?> 
        mini_blog.init(<?php echo json_encode(array(
            'baseurl' => router('settings.root'),
            'lang'    => lang('settings.default')
        )) ?>);
    });
</script>
