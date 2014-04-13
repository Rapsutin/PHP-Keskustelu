<?php

require_once 'libs/mallit/Viesti.php';
require_once 'libs/nakyma.php';

$aiheID = $_GET['id'];
$sivunumero = $_GET['sivu'];

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

