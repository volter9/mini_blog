<nav>
    <div class="fluid clearfix">
        <div class="left">
            <a href="<?php echo url('#index') ?>">
                <?php echo storage('settings.default.sitename') ?> 
            </a>
        </div>
        
        <div class="right">
            <ul>
                <li>
                    <a href="<?php echo url('#index') ?>#features">Особенности</a>
                </li> 
                
                <li>
                    <a href="<?php echo url('#index') ?>#documentation">Документация</a>
                </li> 
                
                <li>
                    <a href="<?php echo url('#posts') ?>">Блог</a>
                </li> 
                
                <?php if (function_exists('users') && users('authorized')): ?> 
                <li>
                    <a href="<?php echo url('#admin_index') ?>">Админка</a>
                </li> 
                <?php endif; ?> 
            </ul>
        </div>
    </div>
</nav>
