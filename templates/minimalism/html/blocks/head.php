<?php
/**
 * HTML head
 * 
 * @var string $title
 */
?>
<meta charset="UTF-8"/>
<title><?php echo $title ?> - <?php echo i18n('header.title') ?></title>

<link href="<?php echo asset_path('css/main.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_path('js/styles/github.css') ?>" rel="stylesheet" type="text/css"/>

<script src="<?php echo asset_path('js/hljs.js') ?>"></script>
<script>hljs.initHighlightingOnLoad();</script>
