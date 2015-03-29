<header class="fluid">
    <h1>
        <a href="<?php echo url('#admin_index') ?>">mini_blog</a>
    </h1>
    
    <ul>
        <li class="active">
            <a href="<?php echo url('#admin_view', ['posts']) ?>">
                <?php echo lang('admin.posts.title') ?> 
            </a>
        </li>
        
        <li>
            <a href="<?php echo url('#admin_view', ['categories']) ?>">
                <?php echo lang('admin.categories.title') ?> 
            </a>
        </li>
        
        <li class="separator">
            <a href="<?php echo url('#admin_view', ['users']) ?>">
                <?php echo lang('admin.users.title') ?> 
            </a>
        </li>
        
        <li>
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
