<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';

$aiheID = $_GET['aiheID'];
$aiheenNimi = $_POST['aiheenNimi'];
$aiheenAlue = $_POST['alue'];

if(isset($aiheenNimi) && isset($aiheenAlue)) {
    $muokattu = Aihe::getAiheJollaID($aiheID);
    $muokattu->setAlue($aiheenAlue);
    $muokattu->setNimi($aiheenNimi);
    
    $muokattu->paivitaTietokantaan();
    
    header('Location: aihe.php?id='.$aiheID);
}
naytaNakyma('muokkaaAihetta.php', array('aiheID' => $aiheID));

