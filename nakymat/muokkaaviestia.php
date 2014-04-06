<?php
require_once '../libs/mallit/Aihe.php';
require_once '../libs/mallit/Viesti.php';
$viesti = Viesti::etsiViestiJollaID($data->viestiID);
?>
<div class="container">

    <h4>Muokkaa viestiä</h4>
    <form action ="muokkaaviestia.php?viestiID=<?php echo $viesti->getId() ?>" method ="POST">
        <textarea rows="6" cols="50" name ="viesti"><?php echo $viesti->getTeksti() ?></textarea>
        <div>
            <button class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span> Muokkaa</button>
            <a type="button" class="btn btn-default" href="muokkaaviestia.php?poista=<?php echo $viesti->getId() ?>"><span class="glyphicon glyphicon-remove-sign"></span> Poista</a>
        </div>
    </form>


