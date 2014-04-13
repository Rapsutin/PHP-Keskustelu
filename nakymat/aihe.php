
<?php 
require_once '../libs/mallit/Kayttaja.php'; 
require_once '../libs/mallit/Aihe.php';
$aihe = Aihe::getAiheJollaID($data->aiheID);

?>
<div class="container">
    <h4>Aihe: <?php echo $aihe->getNimi(); ?></h4>
    <div  class="panel panel-default">
        <table class="table table-bordered">
            <col width="50px" />
            <col width="300px" />
            <?php
            foreach ($data->viestit as $viesti) {
                $kirjoittaja = Kayttaja::etsiKayttajaNimimerkilla($viesti->getKirjoittaja());
                ?>    

                <tr>
                    <td>
                        <p><a href="#"><?php echo $kirjoittaja->getNimimerkki() ?></a></p>
                        <p><img src="http://upload.wikimedia.org/wikipedia/commons/1/1e/G._Rasputin.JPG" style="max-height: 100px; max-width: 100px;" /></p>
                        <p>Liittynyt: <?php echo $kirjoittaja->getLiittymisaika(); ?></p>
                        Viestejä: <?php echo $kirjoittaja->getViesteja(); ?>
                    </td>
                    <td> <?php echo htmlspecialchars($viesti->getTeksti()); ?>
                        <p><div class="btn-group">
                            <?php if (onKirjautunut()) { 
                                    $kirjautunut = (object) $_SESSION['kirjautunut'];
                                    
                            ?>
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-transfer"></span> Vastaa</button>
                                <?php if ($kirjautunut == $kirjoittaja || $kirjautunut->onkoYllapitaja()) { ?>
                                    <a type="button" class="btn btn-default" 
                                       href="muokkaaviestia.php?viestiID=<?php echo $viesti->getID().'&aiheID='.$data->aiheID; ?>"><span class="glyphicon glyphicon-edit"></span> Muokkaa</a>
                                <?php }
                                    }?>
                        </div></p>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <?php if (onKirjautunut()) { ?>
    <a type="button" class="btn btn-default" href="../libs/uusiviesti.php?aiheID=<?php echo $aihe->getID(); ?>">
            <span class="glyphicon glyphicon-share-alt"></span> Uusi viesti
        </a>
    <?php } ?>
    <?php
    echo "Olet sivulla {$data->sivu}/{$data->sivuja}";
    if ($data->sivu > 1):
        ?>
    <a href="aihe.php?sivu=<?php echo $data->sivu - 1; ?>&id=<?php echo $aihe->getID(); ?>">Edellinen sivu</a>
    <?php endif; ?>
    <?php if ($data->sivu < $data->sivuja): ?>
        <a href="aihe.php?sivu=<?php echo $data->sivu + 1; ?>&id=<?php echo $aihe->getID(); ?>">Seuraava sivu</a>
    <?php endif;
    ?>


</div>
