<footer class="fluid" id="footer">
    <div data-component="settings"
         data-group="default">
        <p class="copyright" 
           data-name="copyright"><?php 
            echo storage('settings.default.copyright') 
        ?></p>
    </div>
</footer>

<?php emit('blocks:footer') ?> 
<script src="<?php echo asset_url('js/hljs.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
    var slice = Array.prototype.slice;
    
    slice.call(document.querySelectorAll('#wrapper pre code'))
         .forEach(hljs.highlightBlock);
    
<?php if (users('authorized')): ?>
    mini_blog.posts.view.prototype.render = function () {
        mini_blog.component.view.prototype.render.call(this);
        
        slice.call(this.node.querySelectorAll('pre code'))
             .forEach(hljs.highlightBlock);
    };
<?php endif; ?>
</script>
