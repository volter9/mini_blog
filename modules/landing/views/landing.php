<?php foreach ($sections as $section): ?> 
<div class="wrapper landing" id="<?php echo $section['url'] ?>">
    <?php echo landing_view_section($section) ?> 
</div>
<?php endforeach; ?> 