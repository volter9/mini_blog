<?php
/**
 * HTML head
 * 
 * @var string $title
 */
?>
<meta charset="UTF-8"/>
<title>
    <?php echo $title ?> - <?php echo storage('settings.default.sitename') ?> 
</title>

<link href="<?php echo asset_url('css/styles.css') ?>" 
      rel="stylesheet" 
      type="text/css"/>
<link href="<?php echo module_url('admin', 'css/mini_blog.css') ?>" 
      rel="stylesheet" 
      type="text/css"/>
<!-- Highlight.js theme -->
<link href="<?php echo asset_url('css/monokai_sublime.css') ?>" 
      rel="stylesheet" 
      type="text/css"/>
<!-- FontAwesome -->
<link rel="stylesheet" 
      href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
      type="text/css"/>