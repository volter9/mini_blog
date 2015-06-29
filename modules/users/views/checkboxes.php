<?php if (!is_array($input)) $input = explode('|', $input) ?> 

<ul class="checkboxes">
<?php foreach ($data as $checkbox): ?> 
    <li>
        <label>
        <input name="<?php echo $name ?>[]" 
               type="checkbox" 
               value="<?php echo $checkbox['value'] ?>"
               <?php 
                    echo in_array($checkbox['value'], $input) || 
                         in_array('*', $input) ? 'checked' : '' 
               ?>/> 
        <?php echo lang($checkbox['title']) ?> 
        </label>
    </li>
<?php endforeach; ?> 
</ul>
