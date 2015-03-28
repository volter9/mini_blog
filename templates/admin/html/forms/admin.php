<form action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?> 
        <label>
            <?php if (isset($data['errors'][$field])): ?> 
            <p class="error">
                <?php echo $data['errors'][$field] ?> 
            </p>
            <?php endif; ?> 
            
            <?php build_element(
                $type, array_merge(['name' => $field], pluck($data, $field))
            ) ?> 
            
            <div class="field-name">
                <?php echo $data['field'][$field] ?> 
            </div>
            
            <?php if (isset($data['tooltip'][$field])): ?> 
            <div class="tooltip">
                <?php echo $data['tooltip'][$field] ?> 
            </div>
            <?php endif; ?> 
        </label>
    <?php endforeach; ?> 
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>