<?php
/**
 * HTML head
 * 
 * @var string $title
 */
?>
<meta charset="UTF-8"/>
<title><?php echo $title ?> - <?php echo storage('settings.default.sitename') ?></title>

<link href="<?php echo asset_url('css/main.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo asset_url('js/styles/github.css') ?>" rel="stylesheet" type="text/css"/>

<script src="<?php echo asset_url('js/hljs.js') ?>"></script>
<script>hljs.initHighlightingOnLoad();</script>
