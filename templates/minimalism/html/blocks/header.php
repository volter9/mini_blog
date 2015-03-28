<header>
    <div class="fluid">
        <h1>
            <a href="<?php echo url('#index') ?>">mini_blog</a>
        </h1>
        
        <ul>
            <li>
                <a href="<?php echo url('#index') ?>">home</a>
            </li>
            <?php if (users('authorized')): ?>
            <li>
                <a href="<?php echo url('#admin_index') ?>">admin</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</header>
