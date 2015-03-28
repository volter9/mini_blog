<form action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?>
        <label>
            <?php build_element(
                $type, array_merge(['name' => $field], pluck($data, $field))
            ) ?> 
            
            <?php if (isset($data['errors'][$field])): ?> 
            <p>
                <span class="error">
                    <?php echo $data['errors'][$field] ?> 
                </span>
            </p>
            <?php endif; ?> 
        </label>
    <?php endforeach; ?> 
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>