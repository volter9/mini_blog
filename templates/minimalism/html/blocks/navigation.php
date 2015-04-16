<nav>
    <ul>
        <li>
            <a href="<?php echo url('#index') ?>">
                <?php echo i18n('header.home') ?> 
            </a>
        </li>
        <?php if (function_exists('users') && users('authorized')): ?> 
        <li>
            <a href="<?php echo url('#admin_index') ?>">
                <?php echo i18n('header.admin') ?> 
            </a>
        </li>
        <?php endif; ?> 
    </ul>
</nav>
