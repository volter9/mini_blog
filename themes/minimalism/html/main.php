<?php 
/**
 * Main layout
 * 
 * @var string $title
 * @var string $view
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?> 
    </head>
    
    <body data-baseurl="<?php echo router('settings.root') ?>"
          data-lang="<?php echo lang('settings.default') ?>">
        <div id="mini_panel">
            <div class="clearfix fluid">
                <div class="logo left">
                    <a href="<?php echo url('#index') ?>" 
                       data-name="sitename"><?php 
                        echo storage('settings.default.sitename') 
                    ?></a>
                </div>
                
                <ul class="clearfix right">
                    <li class="status-bar" title="Status bar">
                        ...
                    </li>
                    <li class="separator">
                        <a href="#" title="Add a post">
                            <i class="fa fa-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="More...">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <?php view('blocks/header') ?> 
        
        <div class="fluid" id="wrapper">
            <?php view($view) ?> 
        </div>
        
        <?php view('blocks/footer') ?> 
        
        <script src="<?php echo asset_url('js/hljs.js') ?>"
                type="text/javascript"></script>
        <script src="<?php echo module_url('admin', 'js/mini_blog.js') ?>" 
                type="text/javascript"></script>
        <script type="text/javascript">
            mini_blog.init([
                <?php echo implode(', ', array_map(function ($v) { return "\"$v\""; }, admin_scripts())) ?> 
            ]);
            
            mini_blog.toArray(document.querySelectorAll('#wrapper pre'))
                     .forEach(hljs.highlightBlock);
        </script>
    </body>
</html>