<form class="admin" action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?> 
        <div class="clearfix field">
            <div class="left field-name">
                <label for="form_<?php echo $field ?>">                
                    <?php echo $data['field'][$field] ?> 
                </label>
                
                <?php if (isset($data['tooltip'][$field])): ?> 
                <span class="tooltip">
                    <?php echo $data['tooltip'][$field] ?> 
                </span>
                <?php endif; ?> 
            </div>
            
            <div class="right element">
                <?php build_element(
                    $type, array_merge(array('name' => $field), pluck($data, $field))
                ) ?> 
                
                <?php if (isset($data['errors'][$field])): ?> 
                <p class="error">
                    <?php echo $data['errors'][$field] ?> 
                </p>
                <?php endif; ?> 
            </div>
        </div>
    <?php endforeach; ?> 
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>