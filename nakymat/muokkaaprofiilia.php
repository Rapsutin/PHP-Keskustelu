
<?php 
session_start();
$kirjautunut = $_SESSION['kirjautunut'];
?>

<div class="container">

    <form action ="muokkaaprofiilia.php" method ="POST">
        <h2>Vaihda salasana</h2>
        <div class="input-group">
            Vanha salasana
            <input type="password" style="width: 240px" class="form-control" name="vanhasalasana"></input>
        </div>
        <div class="input-group">
            Uusi salasana
            <input type="password" style="width: 240px" class="form-control" name="uusisalasana"></input>
        </div>
        <div class="input-group">
            Vahvista salasana
            <input type="password" style="width: 240px" class="form-control" name="vahvistasalasana"></input>
        </div>
        <h2>Vaihda profiilikuva</h2>
        <div class="input-group">
            Avatarin URL
            <input type="text" style="width: 240px" class="form-control" name="kuvanURL" value = "<?php echo $kirjautunut->getAvatar();?>"></input>
        </div>
        <div>
            <p></p>
            <button class="btn btn-default" href="#">Tallenna</button>
        </div>
    </form>
</div>

