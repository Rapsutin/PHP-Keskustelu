<?php
require_once 'libs/nakyma.php';
require_once 'libs/mallit/Viesti.php';
require_once 'libs/mallit/Kayttaja.php';

$viestiID = $_GET['viestiID'];
$aiheID = $_GET['aiheID'];
$poistettava = $_GET['poista'];
$viestinTeksti = $_POST['viesti'];
$onkoPainettuLaheta = $_GET['tarkistaViesti'];


$viesti = Viesti::etsiViestiJollaID($viestiID);
session_start();
$kirjoittaja = (object) $_SESSION['kirjautunut'];

if($kirjoittaja->getNimimerkki() != $viesti->getKirjoittaja() && !$kirjoittaja->onkoYllapitaja()) {
    header('Location: aihe.php?id='.$data->aiheID);
}

if(!empty($poistettava)) {
    Viesti::poistaViesti($poistettava);
    header('Location: aihe.php?id='.$aiheID);
}

if(!empty($viestinTeksti) && !empty($viestiID)) {
    Viesti::paivitaViesti($viestiID, $viestinTeksti);
    header('Location: aihe.php?id='.$aiheID);
}

if(empty($viestinTeksti) && isset($onkoPainettuLaheta)) {
    naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID,
                                            'aiheID' => $aiheID,
                                            'virhe' => 'Viesti ei voi olla tyhjä!'));
}


naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID,
                                        'aiheID' => $aiheID));

?>
