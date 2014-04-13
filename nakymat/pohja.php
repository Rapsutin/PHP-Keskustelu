<?php
require_once 'kirjautunut.php';
require_once 'mallit/Kayttaja.php';;
if (onKirjautunut()) {
    session_start();
    $kirjoittaja = $_SESSION['kirjautunut'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-theme.css" rel="stylesheet">
        <link href="../css/main.css" rel="stylesheet">
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
                    <button type="button" class="btn btn-primary navbar-btn" href="#">
                        <?php echo $kirjoittaja->getNimimerkki(); ?>
                    </button>
                <?php } ?>
                <a type="button" class="btn btn-default navbar-btn" href="haku.php">Haku</a>


            </div>
            <div class="navbar-header pull-right">
                <?php if (onKirjautunut()) {?>
                    <form action="uloskirjautuminen.php" method ="GET">
                        <button type="submit" class="btn btn-link navbar-btn">Kirjaudu ulos</button>
                    </form>
                <?php } 
                else {?>
                    <form action="kirjautuminen.php" method ="GET">
                        <button type="submit" class="btn btn-link navbar-btn">Kirjaudu sisään</button>
                    </form>
                <?php } ?>
                    
            </div>

        </div>
        <?php if (!empty($data->virhe)): ?>
            <div class="alert alert-danger"><?php echo $data->virhe; ?></div>
        <?php endif; ?>

        <?php
        require '../nakymat/' . $sivu;
        ?>
    </body>
</html>
