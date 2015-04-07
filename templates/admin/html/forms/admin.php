<form action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?> 
        <div class="clearfix">
            <div class="clearfix">
                <div class="left">
                    <label for="form_<?php echo $field ?>">
                        <div class="field-name">
                            <?php echo $data['field'][$field] ?> 
                        </div>
                    </label>
                </div>
            
                <div class="right">
                    <?php build_element(
                        $type, array_merge(['name' => $field], pluck($data, $field))
                    ) ?> 
                    
                    <?php if (isset($data['errors'][$field])): ?> 
                    <p class="error">
                        <?php echo $data['errors'][$field] ?> 
                    </p>
                    <?php endif; ?> 
                    
                    <?php if (isset($data['tooltip'][$field])): ?> 
                    <div class="tooltip">
                        <?php echo $data['tooltip'][$field] ?> 
                    </div>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    <?php endforeach; ?> 
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>