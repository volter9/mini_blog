<article class="view">
    <h1 class="clearfix">
        <?php echo $header ?> 
        
        <div class="right">
            <a class="button green"
               href="<?php echo url('#admin_add', [$module]) ?>">
                <?php echo lang('admin.admin.add') ?> 
            </a>
        </div>
    </h1>
    
    <div class="columns">
        <div class="left">
            <?php view('basic/views/table') ?> 
            
            <?php view('blocks/pagination', array_merge($pages, [
                'url' => url('#admin_view', [$module])
            ])) ?> 
        </div>
    </div>
</article>