<form class="form" action="<?php echo $scheme['action'] ?>" method="POST">
    <?php if (isset($data['error']) && $errors = $data['error']): ?> 
    <div class="alert red-alert">
        <?php foreach ($errors as $error): ?> 
        <p><?php echo $error ?></p>
        <?php endforeach; ?> 
    </div>
    <?php endif; ?> 
    
    <?php foreach ($scheme['form'] as $field => $type): ?> 
    <div class="field group">
        <div class="field-label left">
            <label for="form_<?php echo $field ?>">
                <?php echo array_get($data, "field.$field", $field) ?>:
            </label>
            
            <?php if ($tooltip = array_get($data, "tooltips.$field")): ?> 
            <div class="field-tooltip">
                <?php echo $tooltip ?>
            </div>
            <?php endif; ?> 
        </div>
        
        <div class="field-element right">
            <?php build_element($type, array_merge(
                array('name' => $field), 
                array_transfer($data, $field)
            )) ?>
        </div> 
    </div>
    <?php endforeach; ?> 
    
    <div class="group">
        <button class="button button-blue right" type="submit">
            <?php echo $scheme['submit'] ?> 
        </button>
    </div>
</form>
