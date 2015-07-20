<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?>
    </head>

    <body>
        <div class="fluid auth-form">
            <h1>
                Войти в админку
            </h1>
    
            <form method="POST">
                <input name="username" placeholder="User name" type="text"/>
                <input name="password" placeholder="Password" type="password"/>
    
                <button>Submit</button>
            </form>
        </div>
    </body>
</html>
