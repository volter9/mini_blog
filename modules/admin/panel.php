<!-- mini_blog admin panel -->
<div id="mini_panel">
    <div class="clearfix fluid">
        <ul class="clearfix right">
            <li class="status-bar failure" title="Status bar">
                <i class="fa fa-exclamation-circle"></i>
                Shit just happenned!
            </li>
            <li class="add">
                <a href="#" title="Create...">
                    <i class="fa fa-plus"></i>
                </a>
                
                <div class="dropdown hidden"></div>
            </li>
            <li class="more">
                <a href="#" title="More...">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="dropdown hidden">
                    Hello, world!
                </div>
            </li>
            <li>
                <a href="<?php echo url('#signout') ?>" 
                   title="Signout out of '<?php echo users('user.username') ?>'">
                    <i class="fa fa-sign-out"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
