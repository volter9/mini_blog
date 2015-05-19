<input id="form_<?php echo $name ?>" 
       name="<?php echo $name ?>" 
       class="<?php echo isset($error) && $error ? 'errored' : '' ?>" 
       type="password" 
       placeholder="<?php echo $field ?>" 
       value="<?php echo $input ?>"/>
