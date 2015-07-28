<!DOCTYPE html>
<html>
    <head>
        <?php view('blocks/head') ?>
    </head>

    <body>
        <div class="fluid auth-form">
            <h1>mini_blog</h1>
            
            <p>Заполните форму ниже для того чтобы войти в систему</p>
    
            <form method="POST">
                <label>
                    Имя пользователя
                    <input name="username" type="text"/>
                </label>
                
                <label>
                    Пароль
                    <input name="password" type="password"/>
                </label>
    
                <button type="submit">Войти</button>
            </form>
        </div>
    </body>
</html>
