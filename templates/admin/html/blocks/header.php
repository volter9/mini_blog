<header class="fluid">
    <h1>
        <a href="<?php echo url('#admin_index') ?>">mini_blog</a>
    </h1>
    
    <ul>
        <li class="active">
            <a href="<?php echo url('#admin_view', ['posts']) ?>">posts</a>
        </li>
        
        <li>
            <a href="<?php echo url('#admin_view', ['categories']) ?>">categories</a>
        </li>
        
        <li class="separator">
            <a href="<?php echo url('#admin_view', ['users']) ?>">users</a>
        </li>
        
        <li>
            <a href="<?php echo url('#index') ?>">home</a>
        </li>
        <li>
            <a href="<?php echo url('#auth_signout') ?>">signout</a>
        </li>
    </ul>
</header>
