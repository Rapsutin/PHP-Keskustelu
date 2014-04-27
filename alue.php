<?php
require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Alue.php';

if(isset($_GET['sivu'])) {
    $sivu = $_GET['sivu'];
} else {
    $sivu = 1;
}

$alue = new Alue($_GET['id']);
$aiheitaAlueella = $alue->getAiheitaAlueella();

$aiheitaSivulla = 10;
$sivuja = $sivuja = ceil($aiheitaAlueella / $aiheitaSivulla);;



naytaNakyma('alue.php', array(  'aiheet' => Aihe::getSivunAiheetAlueella($_GET['id'], $sivu, $aiheitaSivulla),
                                'alueID' => $_GET['id'],
                                'sivuja' => $sivuja,
                                'sivu' => $sivu));





