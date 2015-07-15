<footer class="clearfix fluid" id="footer">
    <div class="left"
         data-component="settings"
         data-group="default">
        <p data-name="copyright"><?php 
            echo storage('settings.default.copyright') 
        ?></p>
    </div>
</footer>

<script src="<?php echo asset_url('js/hljs.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    var pre = document.querySelectorAll('#wrapper pre');
    
    for (var i = 0, l = pre.length; i < l; ++i) {
        hljs.highlightBlock(pre[i]);
    }
</script>
