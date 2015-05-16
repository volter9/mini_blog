<?php
/**
 * Templates view
 * 
 * @var array $data
 */
?>
<ul class="templates group">
    <?php foreach ($data as $key => $template): ?> 
    <li class="left">
        <?php 
            $screenshot = array_get($template, 'screenshot');
            $screenshot = $screenshot ? asset_url("$key:$screenshot") : false;
        ?> 
        <div class="screenshot" 
             style="<?php echo $screenshot ? "background-image: url('$screenshot')" : '' ?>">
        </div>
        
        <div class="header group">
            <div class="left">
                <?php echo $template['name'] ?> 
            </div>
            
            <?php if (
                $template['type'] === 'template' && 
                $key !== storage('settings.default.template')
            ): ?> 
            <a class="button blue right" 
               href="<?php echo url('#admin_templates_choose', array($key)) ?>">
                <?php echo lang('admin.templates.choose') ?> 
            </a>
            <?php else: ?> 
            <span class="button disabled right">
                <?php echo lang('admin.templates.choosen') ?> 
            </span>
            <?php endif; ?>
        </div>
        
        <p><?php echo $template['description'] ?></p>
    </li>
    <?php endforeach; ?> 
</ul>