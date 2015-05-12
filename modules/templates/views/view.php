<?php
/**
 * Templates view
 * 
 * @var array $data
 */
?>
<ul class="templates clearfix">
    <?php foreach ($data as $key => $template): ?> 
    <li>
        <section>
            <?php 
                $screenshot = array_get($template, 'screenshot');
                $screenshot = $screenshot ? asset_url("$key:$screenshot") : false;
            ?> 
            <div class="screenshot" 
                 style="<?php echo $screenshot ? "background-image: url('$screenshot')" : '' ?>"></div>
            
            <div class="header clearfix">
                <div class="left">
                    <?php echo $template['name'] ?> 
                </div>
                
                <?php if (
                    $template['type'] === 'template' && 
                    $key !== storage('settings.default.template')
                ): ?> 
                <a class="right button blue" 
                   href="<?php echo url('#admin_templates_choose', array($key)) ?>">
                    <?php echo lang('admin.templates.choose') ?> 
                </a>
                <?php else: ?> 
                <span class="right button green">
                    <?php echo lang('admin.templates.choosen') ?> 
                </span>
                <?php endif; ?>
            </div>
            
            <p><?php echo $template['description'] ?></p>
        </section>
    </li>
    <?php endforeach; ?> 
</ul>