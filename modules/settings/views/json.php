<script type="text/javascript">
    bootstraping.push(function () {
        mini_blog.settings.collection.bootstrap(<?php
            echo json(storage('settings'))
        ?>);
    });
</script>
