<form class="modify" action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?> 
        <div class="clearfix field">
            <div class="left field-name">
                <label for="form_<?php echo $field ?>">
                    <?php echo $data['field'][$field] ?> 
                </label>
            </div>
            
            <div class="right element">
                <?php build_element($type, array_merge(
                    array('name' => $field), 
                    array_transfer($data, $field)
                )) ?> 
            </div>
        </div>
    <?php endforeach; ?> 
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>