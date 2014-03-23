<?php
//require_once sisällyttää annetun tiedoston vain kerran
require_once "tietokanta/tietokantayhteys.php";
require_once "tietokanta/kayttaja.php";

$kysely = Kayttaja::etsiKaikkiKayttajat()
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $rivit = $kysely->fetchAll();
        
        foreach ($rivit as $rivi) { ?>
        <p>
            <?php
            echo($rivi['nimimerkki'].' ');
            echo($rivi['salasana'].' ');
            
        }
            ?>
        </p>
        
    </body>
</html>
