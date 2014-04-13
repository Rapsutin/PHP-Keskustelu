<?php
require_once 'nakyma.php';
require_once 'mallit/Viesti.php';
require_once 'mallit/Kayttaja.php';

$viesti = Viesti::etsiViestiJollaID($_GET['viestiID']);
session_start();
$kirjoittaja = (object) $_SESSION['kirjautunut'];

if($kirjoittaja->getNimimerkki() != $viesti->getKirjoittaja()) {
    header('Location: aihe.php?id='.$data->aiheID);
}

if(!empty($_GET['poista'])) {
    Viesti::poistaViesti($_GET['poista']);
    header('Location: aihe.php');
}

if(!empty($_POST['viesti']) && !empty($_GET['viestiID'])) {
    Viesti::paivitaViesti($_GET['viestiID'], $_POST['viesti']);
    header('Location: aihe.php?id='.$_GET[aiheID]);
}

$viestiID = $_GET['viestiID'];
$aiheID = $_GET['aiheID'];
naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID,
                                        'aiheID' => $aiheID));

?>
