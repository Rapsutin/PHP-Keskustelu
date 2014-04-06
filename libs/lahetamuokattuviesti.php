<?php
require_once 'mallit/viesti.php';
if(!empty($_POST['viesti'])) {
    Viesti::paivitaViesti($_GET['viestiID'], $_POST['teksti']);
}
?>
