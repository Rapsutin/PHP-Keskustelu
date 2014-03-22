<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PHP-Keskustelu</title>
    </head>
    <body>
        <?php
        require_once 'navigointi.php';
        ?>
        <div class="container">


            <div class="input-group">
                Käyttäjänimi
                <input type="text" style="width: 240px" class="form-control"></input>
            </div>
            <div class="input-group">
                Salasana
                <input type="password" style="width: 240px" class="form-control"></input>
            </div>
            <div>
                <p></p>
                <button href="#">Kirjaudu sisään</button>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Muista kirjautuminen
                </label>
            </div>



        </div>
    </body>
</html>