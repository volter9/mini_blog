<ul>
<?php foreach (menu() as $module): ?> 
<li>
    <a href="<?php echo url($module['url'], $module['args']) ?>">
        <?php echo lang($module['title']) ?>  
    </a>
    <?php if (!empty($module['submenu'])): ?> 
    <ul>
        <?php foreach ($module['submenu'] as $item): ?> 
        <li>
            <a href="<?php echo url($item['url'], $item['args']) ?>">
                <?php echo lang($item['title']) ?> 
            </a>
        </li>
        <?php endforeach; ?> 
    </ul>
    <?php endif; ?> 
</li>
<?php endforeach; ?> 
</ul>