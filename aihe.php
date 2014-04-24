<?php

require_once 'libs/mallit/Viesti.php';
require_once 'libs/mallit/Kayttaja.php';
require_once 'libs/mallit/Luetut.php';
require_once 'libs/nakyma.php';
require_once 'libs/kirjautunut.php';



session_start();

$aiheID = $_GET['id'];
$sivunumero = $_GET['sivu'];

if(onKirjautunut()) {
        $lukija = $_SESSION['kirjautunut'];
        if(!onkoLuettu($lukija->getNimimerkki(), $aiheID)) {
            lisaaLuettu($lukija->getNimimerkki(), $aiheID);
        }
    }

$sivu = 1;
if (isset($sivunumero)) {
    $sivu = (int) $sivunumero;

    if ($sivu < 1)
        $sivu = 1;
}

$viestejaSivulla = 4;
$viestejaAiheessa = Viesti::montaViestiaAiheessa($aiheID);
$sivuja = ceil($viestejaAiheessa / $viestejaSivulla);

$viestit = Viesti::palautaYhdenSivunViestit($viestejaSivulla, $sivu, $aiheID);
naytaNakyma('aihe.php', array('aiheID' => $aiheID,
                              'viestit' => $viestit, 
                              'sivu' => $sivu, 
                              'sivuja' => $sivuja));

?>

