
<?php 
require_once 'libs/mallit/Kayttaja.php'; 
require_once 'libs/kirjautunut.php';
require_once 'libs/mallit/Aihe.php';
require_once 'nakymat/sivuvalinta.php';
$aihe = Aihe::getAiheJollaID($data->aiheID);
?>
<div class="container">
    <h4>Aihe: <?php echo htmlspecialchars($aihe->getNimi()); ?>
        <?php 
        if (onKirjautunut()) {
            if($_SESSION['kirjautunut']->onkoYllapitaja()) {
        ?>
        <a type="button" class="btn btn-link" href="muokkaaAihetta.php?aiheID=<?php echo $aihe->getID(); ?>">
            Muokkaa aihetta
        </a>
        <?php }} ?>
        
    </h4>
    <div  class="panel panel-default">
        <table class="table table-bordered">
            <col width="170px" />
            <col width="1000px" />
            <?php
            foreach ($data->viestit as $viesti):
                $kirjoittaja = Kayttaja::etsiKayttajaNimimerkilla($viesti->getKirjoittaja());
                
                ?>    

                <tr>
                    <td>
                        <p><?php echo htmlspecialchars($kirjoittaja->getNimimerkki()); ?></p>
                        <p><img src="<?php echo htmlspecialchars($kirjoittaja->getAvatar()); ?>" style="max-height: 100px; max-width: 100px;" /></p>
                        <p>Liittynyt: <?php echo $kirjoittaja->getLiittymisaika(); ?></p>
                        Viestejä: <?php echo $kirjoittaja->getViesteja(); ?>
                    </td>
                    <td> <?php $teksti = $viesti->getTeksti(); htmlspecialchars(Viesti::parseroiLainaukset($teksti));?>
                        <p><div class="btn-group">
                            <?php if (onKirjautunut()) { 
                                    $kirjautunut = (object) $_SESSION['kirjautunut'];
                                    
                            ?>
                                <a type="button" class="btn btn-default" href="uusiviesti.php?vastattavanID=<?php echo $viesti->getID().'&aiheID='.$data->aiheID; ?>"><span class="glyphicon glyphicon-transfer"></span> Vastaa</a>
                                <?php if ($kirjautunut->getNimimerkki() == $kirjoittaja->getNimimerkki() || $kirjautunut->onkoYllapitaja()) { ?>
                                    <a type="button" class="btn btn-default" 
                                       href="muokkaaviestia.php?viestiID=<?php echo $viesti->getID().'&aiheID='.$data->aiheID; ?>"><span class="glyphicon glyphicon-edit"></span> Muokkaa</a>
                                <?php }
                                    }?>
                        </div></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php if (onKirjautunut()) { ?>
    <a type="button" class="btn btn-default" href="uusiviesti.php?aiheID=<?php echo $aihe->getID(); ?>">
            <span class="glyphicon glyphicon-share-alt"></span> Uusi viesti
        </a>
    
    <?php } 
        luoSivuvalinta('aihe.php?id='.$data->aiheID, $data->sivu, $data->sivuja);
    
    ?>


</div>
