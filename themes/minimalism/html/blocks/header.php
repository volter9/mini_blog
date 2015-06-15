<header class="clearfix" id="header">
    <div class="fluid">
        <h1>
            <a href="<?php echo url('#index') ?>">
                <?php echo storage('settings.default.sitename') ?> 
            </a>
        </h1>
        
        <nav class="clearfix" id="navigation">
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
    </div>
</header>
