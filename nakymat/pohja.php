<?php
require_once 'libs/kirjautunut.php';
require_once 'libs/mallit/Kayttaja.php';

if (onKirjautunut()) {
    session_start();
    $kirjoittaja = $_SESSION['kirjautunut'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>PHP-Keskustelu</title>
    </head>
    <body>

        <div class="navbar navbar-fixed-top navbar-default">
            <div class="navbar-header pull-left">
                <a class="navbar-brand" href="etusivu.php">PHP-Keskustelu</a>
            </div>
            <div class="navbar-header pull-left">

                <?php if (onKirjautunut()) { ?>
                    <a type="button" class="btn btn-primary navbar-btn" href="muokkaaprofiilia.php">
                        <?php echo $kirjoittaja->getNimimerkki(); ?>
                    </a>
                <?php } ?>
<!--                <a type="button" class="btn btn-default navbar-btn" href="haku.php">Haku</a>-->


            </div>
            <div class="navbar-header pull-right">
                <?php if (onKirjautunut()) {?>
                    <form action="libs/uloskirjautuminen.php" method ="GET">
                        <button type="submit" class="btn btn-link navbar-btn">Kirjaudu ulos</button>
                    </form>
                <?php } 
                else {?>
                    <form action="kirjautuminen.php" method ="GET">
                        <button type="submit" class="btn btn-link navbar-btn">Kirjaudu sisään/Rekisteröidy</button>
                    </form>
                <?php } ?>
                    
            </div>

        </div>
        <?php if (!empty($data->virhe)): ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
        <?php endif; 
              if(isset($_SESSION['virhe'])): ?>
                  <div class="alert alert-danger"><?php echo $_SESSION['virhe'];?></div>
              <?php unset($_SESSION['virhe']); endif;?>

            

        <?php
        require 'nakymat/' . $sivu;
        ?>
    </body>
</html>
