<footer class="fluid" id="footer">
    <div data-component="settings"
         data-group="default">
        <p class="copyright" data-name="copyright"><?php 
            echo storage('settings.default.copyright') 
        ?></p>
    </div>
</footer>

<script src="<?php echo asset_url('js/hljs.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    var slice = Array.prototype.slice;
    
    slice.call(document.querySelectorAll('#wrapper pre'))
         .forEach(hljs.highlightBlock);
</script>

<?php emit('blocks:footer') ?> 
