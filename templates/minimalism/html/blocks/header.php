<header>
    <div class="fluid">
        <h1>
            <a href="<?php echo url('#index') ?>">
                <?php echo i18n('header.title') ?> 
            </a>
        </h1>
        
        <ul>
            <li>
                <a href="<?php echo url('#index') ?>">
                    <?php echo i18n('header.home') ?> 
                </a>
            </li>
            <?php if (users('authorized')): ?> 
            <li>
                <a href="<?php echo url('#admin_index') ?>">
                    <?php echo i18n('header.admin') ?> 
                </a>
            </li>
            <?php endif; ?> 
        </ul>
    </div>
</header>
