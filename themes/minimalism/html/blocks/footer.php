<footer class="clearfix fluid" id="footer">
    <p class="left">
        <?php 
            $sitename = storage('settings.default.sitename');
            $year = date('Y');
            
            echo "&copy; $year $sitename";  
        ?>
    </p>
</footer>
