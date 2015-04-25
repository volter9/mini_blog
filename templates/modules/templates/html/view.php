<?php
/**
 * Templates view
 * 
 * @var array $data
 */
?>
<ul class="templates">
    <?php foreach ($data as $key => $template): ?> 
    <li>
        <section>
            <div class="header clearfix">
                <div class="left">
                    <?php echo $template['name'] ?> 
                    &dash; <?php echo $template['version'] ?> 
                </div>
                
                <?php if ($template['type'] === 'template'): ?> 
                <a class="right button blue" 
                   href="<?php echo url('#admin_templates_choose', array($key)) ?>">
                    <?php echo lang('admin.templates.choose') ?> 
                </a>
                <?php endif; ?> 
            </div>
            
            <?php if ($key === storage('settings.default.template')): ?> 
            <p><?php echo lang('admin.templates.used') ?></p>
            <?php endif; ?> 
            
            <p>
                <?php echo lang('admin.templates.author') ?>: 
                <?php echo $template['author'] ?> 
            </p>
            
            <p>
                <?php echo lang('admin.templates.description') ?>: 
                <?php echo $template['description'] ?> 
            </p>
        </section>
    </li>
    <?php endforeach; ?> 
</ul>