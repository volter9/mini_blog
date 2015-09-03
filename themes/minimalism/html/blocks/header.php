<?php emit('blocks:header') ?> 

<header id="header">
    <div class="fluid">
        <div data-component="settings"     
             data-group="default">
            <h1>
                <a href="<?php echo url('#index') ?>" 
                   class="header"
                   data-name="sitename"><?php 
                    echo storage('settings.default.sitename')
                ?></a>
            </h1>
        
            <p class="site-description" 
               data-name="sitedescription"><?php 
                echo storage('settings.default.sitedescription')
            ?></p>
        </div>
    </div>
</header>
