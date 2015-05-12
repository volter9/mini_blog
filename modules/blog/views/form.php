<form class="modify" action="<?php echo $scheme['action'] ?>" method="POST">
    <div class="columns-2">
        <div class="left">
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
        </div>
    
        <div class="right">
            <section class="container">
                <h2>Дополнительные поля</h2>
            
                <?php foreach (array('url' => 'input', 'description' => 'text') as $field => $type): ?> 
                <div class="field">
                    <label for="form_<?php echo $field ?>">
                        <?php echo $data['field'][$field] ?> 
                    </label>
        
                    <div class="element">
                        <?php build_element($type, array_merge(
                            array('name' => $field), 
                            array_transfer($data, $field)
                        )) ?> 
                    </div>
                </div>
                <?php endforeach; ?> 
            </section>
        </div>
    </div>
    
    <button class="button blue" type="submit">
        <?php echo $scheme['submit'] ?> 
    </button>
</form>