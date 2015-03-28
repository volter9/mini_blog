<select name="<?php echo $name ?>">
    <?php foreach ($data as $row): ?> 
    <option value="<?php echo $row['value'] ?>"
            <?php echo $input == $row['value'] ? 'selected' : '' ?>>
        <?php echo $row['title'] ?> 
    </option>
    <?php endforeach; ?> 
</select>
