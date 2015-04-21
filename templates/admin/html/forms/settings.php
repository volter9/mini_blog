<form class="settings" action="<?php echo $scheme['action'] ?>" method="POST">
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
                        $type, array_merge(array('name' => $field), pluck($data, $field))
                    ) ?> 
                </div>
            </div>
        </div>
    <?php endforeach; ?> 
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>