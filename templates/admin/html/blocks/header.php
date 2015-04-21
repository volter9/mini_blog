<header>
    <h1>
        <a href="<?php echo url('#admin_index') ?>">mini_blog</a>
    </h1>
    
    <div class="clearfix profile">
        <div class="left">
            <?php echo lang('admin.auth.hello') ?>, 
            <?php echo users('user.username') ?>
        </div>
        
        <div class="right">
            <a href="<?php echo url('#auth_signout') ?>">
                <?php echo lang('admin.auth.signout') ?> 
            </a>
        </div>
    </div>
    
    <ul>
        <li>
            <a href="<?php echo url('#index') ?>">
                <?php echo lang('admin.admin.home') ?> 
            </a>
        </li>
    
    <?php if (function_exists('menu') && $modules = menu()): ?> 
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
    </ul>
</header>
