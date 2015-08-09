<?php emit('blocks:header') ?> 

<header id="header">
    <div class="fluid">
        <div class="settings"
             data-component="settings"     
             data-group="default">
            <h1>
                <a href="<?php echo url('#index') ?>" 
                   data-name="sitename"><?php 
                    echo storage('settings.default.sitename') 
                ?></a>
            </h1>
        
            <p data-name="sitedescription"><?php 
                echo storage('settings.default.sitedescription') 
            ?></p>
        </div>
    </div>
</header>
