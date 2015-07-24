<footer class="clearfix fluid" id="footer">
    <div class="left"
         data-component="settings"
         data-group="default">
        <p data-name="copyright"><?php 
            echo storage('settings.default.copyright') 
        ?></p>
        <p>
            С уважением, 
            <span data-name="sitename"><?php
            echo storage('settings.default.sitename')
            ?></span>
        </p>
    </div>
</footer>

<script src="<?php echo asset_url('js/hljs.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    var slice = Array.prototype.slice;
    
    slice.call(document.querySelectorAll('#wrapper pre'))
         .forEach(hljs.highlightBlock);
</script>

<?php emit('blocks:footer') ?> 
