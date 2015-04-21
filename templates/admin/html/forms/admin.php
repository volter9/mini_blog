<form class="admin" action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?> 
        <div class="clearfix">
            <label for="form_<?php echo $field ?>">
                <div class="field-name">
                    <?php echo $data['field'][$field] ?> 
                    
                    <?php if (isset($data['tooltip'][$field])): ?> 
                    <span class="tooltip">
                        &dash; 
                        <?php echo $data['tooltip'][$field] ?> 
                    </span>
                    <?php endif; ?> 
                </div>
            </label>
            
            <div class="element">
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