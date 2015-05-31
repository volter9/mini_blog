<form class="form" action="<?php echo $scheme['action'] ?>" method="POST">
    <?php foreach ($scheme['form'] as $field => $type): ?> 
    <div class="field group">
        <div class="field-label left">
            <label for="form_<?php echo $field ?>">
                <?php echo array_get($data, "field.$field", $field) ?> 
            </label>
        </div>
        
        <div class="field-element right">
            <?php build_element($type, array_merge(
                array('name' => $field), 
                array_transfer($data, $field)
            )) ?>
        </div> 
    </div>
    <?php endforeach; ?> 
    
    <button class="button button-blue button-large button-block" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>
