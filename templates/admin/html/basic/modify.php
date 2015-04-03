<?php
/**
 * Modify a module entry
 * 
 * @var string $header
 * @var string $module
 * @var bool $edit
 * @var array $scheme
 * @var array $data
 */
?>
<article class="modify">
    <h1 class="clearfix">
        <?php echo $header ?> 
        
        <?php if (!empty($edit)): ?> 
        <div class="right">
            <a class="button red"
               href="<?php echo url('#admin_remove', [$module, $data['input']['id']]) ?>">
                <?php echo lang('admin.admin.remove') ?> 
            </a>
        </div>
        <?php endif; ?> 
    </h1>
    
    <?php build_form($scheme, $data) ?> 
</article>

<script>
    /** Disabling double click on submit button */
    var form = document.forms[0];
    
    form.addEventListener('submit', function () {
        var button = this.querySelector('button[type=submit]');
        
        button.setAttribute('disabled', 'disabled');
    });
</script>