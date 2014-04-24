



<div class="container">

    <h2>Kirjautuminen</h2>
    <form action ="kirjautuminen.php" method ="POST">
        <div class="input-group">
            Käyttäjänimi
            <input type="text" style="width: 240px" class="form-control" name="nimimerkki"
                   value="<?php echo $data->kayttaja; ?>"></input>
        </div>
        <div class="input-group">
            Salasana
            <input type="password" style="width: 240px" class="form-control" name="salasana"></input>
        </div>
        <div>
            <p></p>
            <button type="laheta">Kirjaudu sisään</button>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="muista"> Muista kirjautuminen
            </label>
        </div>
    </form>



    <form action ="rekisteroityminen.php" method ="POST">
        <h2>Rekisteröityminen</h2>
        <div class="input-group">
            Käyttäjänimi
            <input type="text" style="width: 240px" class="form-control" name="uusinimi" value="<?php echo $data->kayttajanimi ?>"></input>
        </div>
        <div class="input-group">
            Salasana
            <input type="password" style="width: 240px" class="form-control" name="uusisalasana"></input>
        </div>
        <div class="input-group">
            Vahvista salasana
            <input type="password" style="width: 240px" class="form-control" name="vahvistasalasana"></input>
        </div>
        <div>
            <p></p>
            <button href="#">Rekisteröidy</button>
        </div>
    </form>
</div>

