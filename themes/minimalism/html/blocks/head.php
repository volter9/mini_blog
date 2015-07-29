<?php
/**
 * HTML head
 * 
 * @var string $title
 * @var string $description
 */
?>
<meta charset="UTF-8"/>
<title>
    <?php echo htmlspecialchars($title) ?>
</title>
<?php if (isset($description)): ?>
<meta name="description" content="<?php echo htmlspecialchars($description) ?>"/>
<?php endif; ?>

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
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"
      rel="stylesheet" 
      type="text/css"/>
<!-- Fonts -->
<link href="http://fonts.googleapis.com/css?family=Lato|Open+Sans:300" 
      rel="stylesheet" 
      type="text/css">

<?php emit('blocks:head') ?>
