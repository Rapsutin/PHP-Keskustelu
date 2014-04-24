<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Kayttaja.php';

$aiheID = $_GET['aiheID'];
$aiheenNimi = trim($_POST['aiheenNimi']);

$aiheenAlue = $_POST['alue'];
$poistettava = $_GET['poista'];

if(isset($poistettava)) {
    $aihe = Aihe::getAiheJollaID($poistettava);
    $alue = $aihe->getAlue();
}

session_start();
$muokkaaja = $_SESSION['kirjautunut'];

if(!isset($muokkaaja) || !$muokkaaja->onkoYllapitaja()) {
    $_SESSION['virhe'] = 'Sinun on oltava ylläpitäjä käyttääksesi tätä toimintoa!';
    header('Location: aihe.php?id='.$aiheID);
    exit();
}


//Muokkaukset tehty.
if(isset($aiheenNimi) && isset($aiheenAlue)) {
    if(Aihe::tarkistaNimi($aiheenNimi) != null) {
        naytaNakyma('muokkaaAihetta.php', array('virhe' => Aihe::tarkistaNimi($aiheenNimi),
                                                'aiheID' => $aiheID,
                                                'keskenerainenNimi' => $aiheenNimi));
        exit();
    }
    $muokattu = Aihe::getAiheJollaID($aiheID);
    $muokattu->setAlue($aiheenAlue);
    $muokattu->setNimi($aiheenNimi);
    
    $muokattu->paivitaTietokantaan();
    
    header('Location: aihe.php?id='.$aiheID);
    exit();
}

if(isset($poistettava)) {
    $poistettavaAihe = Aihe::getAiheJollaID($poistettava);
    $poistettavaAihe->poistaTietokannasta();
    
    header('Location: alue.php?id='.$alue);
    exit();
}
naytaNakyma('muokkaaAihetta.php', array('aiheID' => $aiheID));

