<?php
/**
 * Table view
 * 
 * @var array $data
 */
?>
<table class="table">
    <thead>
        <tr>
            <?php $keys = array_keys($data[0]); unset($keys[array_search('id', $keys)]); ?> 
            <?php foreach ($keys as $field): ?> 
            <th class="<?php echo $field ?>">
                <?php echo lang("admin.$module.fields.$field") ?> 
            </th>
            <?php endforeach; ?> 
            <th>
                <?php echo lang('admin.common.actions') ?> 
            </th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($data as $field): ?> 
        <tr>
            <?php $filtered = $field; unset($filtered['id']); ?> 
            <?php foreach ($filtered as $key => $value): ?> 
            <td class="<?php echo $key ?>">
                <?php echo $value ?> 
            </td>
            <?php endforeach; ?> 
        
            <td class="edit">
                <a class="edit" 
                   href="<?php echo url('#admin_edit', array($module, $field['id'])) ?>">&#9998;</a> 
                <a class="remove" 
                   href="<?php echo url('#admin_remove', array($module, $field['id'])) ?>">&#10005;</a>
            </td>
        </tr>
        <?php endforeach; ?> 
    </tbody>
</table>