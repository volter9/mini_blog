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

<?php emit('blocks:head') ?> 
<link href="<?php echo asset_url('css/styles.css') ?>" 
      rel="stylesheet" 
      type="text/css"/>
<!-- Highlight.js theme -->
<link href="<?php echo asset_url('css/monokai_sublime.css') ?>" 
      rel="stylesheet" 
      type="text/css"/>
<!-- Fonts -->
<link href="http://fonts.googleapis.com/css?family=Lato|Open+Sans:300" 
      rel="stylesheet" 
      type="text/css">
