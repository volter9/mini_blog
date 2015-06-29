<?php
/**
 * Table view
 * 
 * @var array $data
 */
?>
<div class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <?php $keys = array_keys($data[0]); unset($keys[array_search('id', $keys)]); ?> 
                <?php foreach ($keys as $field): ?> 
                <th class="<?php echo $field ?>">
                    <?php echo isset($fields[$field]) ? $fields[$field] : $field ?> 
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
                    <a class="button button-blue" 
                       href="<?php echo url('#admin_edit', array($module, $field['id'])) ?>">
                        <?php echo lang('admin.common.edit') ?> 
                    </a> 
                
                    <a class="button button-red" 
                       href="<?php echo url('#admin_remove', array($module, $field['id'])) ?>">
                        <?php echo lang('admin.common.remove') ?>    
                    </a>
                </td>
            </tr>
            <?php endforeach; ?> 
        </tbody>
    </table>
</div>