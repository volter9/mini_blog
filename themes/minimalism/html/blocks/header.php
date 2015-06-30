<header id="header">
    <div class="clearfix fluid">
        <div class="left">
            <h1>
                <a href="<?php echo url('#index') ?>">
                    <?php echo storage('settings.default.sitename') ?> 
                </a>
            </h1>
            
            <p>Мой блог о моей карьере</p>
        </div>
        
        <nav class="right clearfix" id="navigation">
            <ul>
                <li>
                    <a href="<?php echo url('#index') ?>">
                        <?php echo i18n('header.home') ?> 
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('#index') ?>">
                        Админка
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('#index') ?>">
                        О нас
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('#index') ?>">
                        Контакты
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
