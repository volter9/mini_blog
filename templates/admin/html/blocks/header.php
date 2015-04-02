<header class="fluid">
    <h1>
        <a href="<?php echo url('#admin_index') ?>">mini_blog</a>
    </h1>
    
    <ul>
        <?php if ($modules = modules()): ?> 
            <?php foreach ($modules as $name => $module): ?> 
            <li>
                <a href="<?php echo url('#admin_view', [$name]) ?>">
                    <?php echo lang("admin.$name.title") ?> 
                </a>
            </li>
            <?php endforeach;  ?>
        <?php endif; ?>
        
        <li class="separator">
            <a href="<?php echo url('#index') ?>">
                <?php echo lang('admin.admin.home') ?> 
            </a>
        </li>
        <li>
            <a href="<?php echo url('#auth_signout') ?>">
                <?php echo lang('admin.auth.signout') ?> 
            </a>
        </li>
    </ul>
</header>
