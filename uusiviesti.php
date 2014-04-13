<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Viesti.php';
require_once 'libs/mallit/Kayttaja.php';
require_once 'libs/kirjautunut.php';

$aiheID = (int) $_GET['aiheID'];

if (!onKirjautunut()) {
    header("Location: aihe.php?id=" . $aiheID);
}


//Jos viesti on kirjoitettu, niin lisätään se kantaan.
if (!empty($_POST['viesti'])) {
    session_start();
    $postaushetki = date('Y-m-d G:i:s');
    $kirjoittaja = $_SESSION['kirjautunut'];
    $kayttajanNimimerkki = $kirjoittaja->getNimimerkki();


    $viesti = new Viesti(-1, $kayttajanNimimerkki, $postaushetki, $_POST['viesti'], $aiheID);
    $viesti->lisaaKantaan();
    
    $kirjoittaja->lisaaYksiViestilaskuriin();
    header('Location: aihe.php?id=' . $aiheID);
} 

if($_GET['tarkistaViesti'] == 1 && empty($_POST['viesti'])) {
    naytaNakyma('uusiviesti.php', array('aihe' => Aihe::getAiheJollaID($aiheID),
                                        'virhe' => 'Viesti ei saa olla tyhjä!'));
}



if (isset($_GET['aiheID'])) {
    $aiheID = $_GET['aiheID'];
    naytaNakyma('uusiviesti.php', array('aihe' => Aihe::getAiheJollaID($aiheID)));
} else {
    naytaNakyma('alue.php', array('virhe' => 'Virheellinen URL!'));
}
?>
