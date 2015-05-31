<select class="<?php echo isset($error) ? 'errored' : '' ?>" name="<?php echo $name ?>">
    <?php array_unshift($data, array(
        'title' => lang('admin.common.none'),
        'value' => ends_with($name, '_id') ? 0 : ''
    )) ?>
    
    <?php foreach ($data as $row): ?> 
    <option value="<?php echo $row['value'] ?>"
            <?php echo (string)$input === (string)$row['value'] ? 'selected' : '' ?>>
        <?php echo $row['title'] ?> 
    </option>
    <?php endforeach; ?> 
</select>
