<?php
/**
 * Groups view
 * 
 * @var array $data
 */
$providers = require module_path('users', 'providers.php');
$providers = $providers['privileges'];
$providers = array_join($providers(), 'value', 'title');
?>
<ul class="groups group">
    <?php foreach ($data as $group): ?> 
    <li class="left">
        <div class="header group">
            <div class="left">
                <?php echo $group['name'] ?> 
            </div>
            
            <div class="right edit">
                <a class="button button-blue" 
                   href="<?php echo url('#admin_edit', array($module, $group['id'])) ?>">
                    <?php echo lang('admin.common.edit') ?> 
                </a>
                
                <a class="button button-red" 
                   href="<?php echo url('#admin_remove', array($module, $group['id'])) ?>">
                   <?php echo lang('admin.common.remove') ?> 
                </a>
            </div>
        </div>
        
        <p class="description">
            <?php echo lang('admin.groups.privileges') ?> 
            <?php $privileges = explode(',', $group['privileges']) ?> 
        </p>
        
        <ul class="privileges">
        <?php foreach ($privileges as $privilege): ?> 
            <li><?php echo lang($providers[$privilege]) ?></li>
        <?php endforeach; ?> 
        </ul>
    </li>
    <?php endforeach; ?> 
</ul>