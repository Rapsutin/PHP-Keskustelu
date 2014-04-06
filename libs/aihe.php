<?php

//require_once sisällyttää annetun tiedoston vain kerran
require_once '../libs/mallit/Viesti.php';
require_once 'nakyma.php';

$sivu = 1;
if (isset($_GET['sivu'])) {
    $sivu = (int) $_GET['sivu'];

    if ($sivu < 1)
        $sivu = 1;
}

$viestejaSivulla = 4;
$viestejaAiheessa = Viesti::montaViestiaAiheessa(1);
$sivuja = ceil($viestejaAiheessa / $viestejaSivulla);

$viestit = Viesti::palautaYhdenSivunViestit($viestejaSivulla, $sivu, 1);
naytaNakyma('aihe.php', array('viestit' => $viestit, 'sivu' => $sivu, 'sivuja' => $sivuja));
?>

