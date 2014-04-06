<?php
require_once 'nakyma.php';
require_once 'mallit/Viesti.php';
require_once 'mallit/Kayttaja.php';

$viesti = Viesti::etsiViestiJollaID($_GET['viestiID']);
session_start();
$kayttaja = (object) $_SESSION['kirjautunut'];

if($kayttaja->getNimimerkki() != $viesti->getKirjoittaja()) {
    header('Location: aihe.php');
}

if(!empty($_GET['poista'])) {
    Viesti::poistaViesti($_GET['poista']);
    header('Location: aihe.php');
}

if(!empty($_POST['viesti']) && !empty($_GET['viestiID'])) {
    Viesti::paivitaViesti($_GET['viestiID'], $_POST['viesti']);
    header('Location: aihe.php');
}

$viestiID = $_GET['viestiID'];
naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID));

?>
