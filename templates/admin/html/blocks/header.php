<header class="fluid">
    <h1>
        <a href="<?php echo url('#admin_index') ?>">mini_blog</a>
    </h1>
    
    <ul>
    <?php if ($modules = modules('menu')): ?> 
        <?php foreach ($modules as $module): ?> 
        <li>
            <a href="<?php echo $module['url'] ?>">
                <?php echo $module['title'] ?>  
            </a>
            <?php if (isset($module['submenu'])): ?> 
            <ul>
                <?php foreach ($module['submenu'] as $item): ?> 
                <li>
                    <a href="<?php echo $item['url'] ?>">
                        <?php echo $item['title'] ?> 
                    </a>
                </li>
                <?php endforeach; ?> 
            </ul>
            <?php endif; ?> 
        </li>
        <?php endforeach; ?> 
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
