
<?php
require_once 'libs/mallit/Aihe.php';

$aihe = $data->aihe;

?>
<div class="container">

    <h4>Uusi kirjoitus aiheeseen <a href="aihe.php?id=<?php echo $aihe->getID(); ?>"><?php echo htmlspecialchars($aihe->getNimi()); ?></a></h4>
    <form action ="uusiviesti.php?aiheID=<?php echo $aihe->getID().'&tarkistaViesti=1'; ?>" method ="POST">
        <textarea rows="6" cols="50" name ="viesti"><?php echo htmlspecialchars($data->teksti); ?></textarea>
        <div>
            <button class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span> Lähetä</button>
        </div>
    </form>
</div>
