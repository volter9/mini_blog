<header id="header">
    <nav id="menu">
        <div class="fluid clearfix">
            <div class="left">
                <h1>
                    <a href="<?php echo url('#admin_index') ?>">mini_blog</a>
                </h1>
    
                <div class="clearfix profile">
                    <?php echo lang('admin.auth.hello') ?>, 
                    <?php echo users('user.username') ?>.
                    
                    <a href="<?php echo url('#auth_signout') ?>">
                        <?php echo lang('admin.auth.signout') ?>?
                    </a>
                </div>
            </div>
            
            <ul class="left menu">
            <?php foreach (menu() as $menu): ?> 
                <li>
                    <a href="<?php echo url($menu['url'], $menu['args']) ?>">
                        <?php echo lang($menu['title']) ?> 
                    </a>
                    
                    <?php if ($submenus = $menu['submenu']): ?> 
                    <ul>
                    <?php foreach ($submenus as $submenu): ?> 
                        <li>
                            <a href="<?php echo url($submenu['url'], $submenu['args']) ?>">
                                <?php echo lang($submenu['title']) ?> 
                            </a>
                        </li>
                    <?php endforeach; ?> 
                    </ul>
                    <?php endif; ?> 
                </li>
            <?php endforeach; ?> 
            </ul>
        </div>
    </nav>
    
    <div class="fluid clearfix">
        <div class="left">
            <a href="<?php echo url('#index') ?>">
                <?php echo lang('admin.admin.home') ?> 
            </a>
        </div>
        
        <div id="menu_button" class="right">
            Меню
        </div>
    </div>
</header>
