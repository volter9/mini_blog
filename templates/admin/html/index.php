<article class="index">
    <div class="columns-2">
        <div class="left">
            <?php $parse = new Parsedown; echo $parse->text(file_get_contents(base_path('README.md'))) ?>
        </div>

        <div class="right">
            <h2>Меню</h2>
            
            <?php view('blocks/menu') ?> 
        </div>
    </div>
</article>