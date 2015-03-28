<article class="modify">
    <h1 class="clearfix">
        <?php echo $header ?> 
        
        <?php if ($edit): ?> 
        <div class="right">
            <a class="button red"
               href="<?php echo url('#admin_remove', [$module, $data['input']['id']]) ?>">
                Remove
            </a>
        </div>
        <?php endif; ?> 
    </h1>
    
    <?php build_form($scheme, $data) ?> 
</article>