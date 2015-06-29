<textarea id="form_<?php echo $name ?>" 
          name="<?php echo $name ?>" 
          class="<?php echo isset($error) && $error ? 'errored' : '' ?>" 
          placeholder="<?php echo $field ?>"><?php echo $input ?></textarea>
