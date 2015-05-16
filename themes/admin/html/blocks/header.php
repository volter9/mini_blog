<header id="header">
    <div class="group wrapper">
        <ul class="left">
            <li id="logo">
                <a href="<?php echo url('#admin_index') ?>" title="mini_blog">
                    m
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('#index') ?>">
                    <?php echo lang('admin.common.view_site') ?>
                </a>
            </li>
        </ul>
    
        <ul class="right">
            <li>
                <a href="<?php echo url('#admin_index') ?>">
                    <?php echo lang('admin.common.modules') ?>
                </a>
                
                <ul>
                <?php foreach (menu() as $menu): ?> 
                    <li>
                        <a href="<?php echo url($menu['url'], $menu['args']) ?>">
                            <?php echo lang($menu['title']) ?> 
                        </a>
                    </li>
                <?php endforeach ?> 
                </ul>
            </li>
            
            <li>
                <a href="<?php echo url('#auth_signout') ?>">
                    <?php echo lang('admin.auth.signout') ?>
                </a>
            </li>
        </ul>
    </div>
</header>