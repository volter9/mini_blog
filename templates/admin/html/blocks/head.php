<?php
/**
 * Head block
 * 
 * @var string $title
 */
?>
<meta charset="UTF-8"/>
<title><?php echo $title ?> - <?php echo lang('admin.admin.title') ?></title>

<script>
    if (localStorage.getItem('toggle') === null) {
        localStorage.setItem('toggle', '0');
    }
    
    window.addEventListener('DOMContentLoaded', function () {
        var toggleMenu = function (toggle) {
            document.getElementById('menu').style.display = toggle ? 'block' : 'none';
        };
        
        document.getElementById('menu_button').addEventListener('click', function () {
            var toggle = +localStorage.getItem('toggle');
            
            localStorage.setItem('toggle', +(toggle = !toggle));
            
            toggleMenu(toggle);
        });
        
        toggleMenu(+localStorage.getItem('toggle'));
    });
</script>