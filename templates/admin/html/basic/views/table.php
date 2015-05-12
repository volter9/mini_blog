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
            <?php echo lang("admin.$module.fields.$field") ?> 
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
            <a class="link blue" 
               href="<?php echo url('#admin_edit', array($module, $field['id'])) ?>">
                <i class="fa fa-pencil"></i>
            </a>
            &nbsp;
            <a class="link red" 
               href="<?php echo url('#admin_remove', array($module, $field['id'])) ?>">
                <i class="fa fa-close"></i>
            </a>
        </td>
    </tr>
    <?php endforeach; ?> 
</table>