<div class="clearfix">
    <select name="<?php echo $name ?>">
        <?php foreach ($data as $row): ?> 
        <option value="<?php echo $row['value'] ?>"
                <?php echo (string)$input === (string)$row['value'] ? 'selected' : '' ?>>
            <?php echo $row['title'] ?> 
        </option>
        <?php endforeach; ?> 
    </select>
</div>