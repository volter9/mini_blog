<?php
/**
 * Table view
 * 
 * @var array $data
 */
?>
<table>
    <tr>
        <?php $keys = array_slice(array_keys($data[0]), 1) ?> 
        <?php foreach ($keys as $field): ?> 
        <th class="<?php echo $field ?>">
            <?php echo lang("admin.$module.fields.$field") ?: $field ?> 
        </th>
        <?php endforeach; ?> 
        <th></th>
    </tr>
    
    <?php foreach ($data as $field): ?> 
    <tr>
        <?php $filtered = $field; unset($filtered['id']); ?> 
        <?php foreach ($filtered as $key => $value): ?> 
        <td class="<?php echo $key ?>">
            <?php echo $value ?> 
        </td>
        <?php endforeach; ?> 
        
        <td class="edit">
            <a class="button blue" 
               href="<?php echo url('#admin_edit', [$module, $field['id']]) ?>">
                <?php echo lang('admin.admin.edit') ?> 
            </a>
        </td>
    </tr>
    <?php endforeach; ?> 
</table>