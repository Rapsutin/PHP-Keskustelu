<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Kayttaja.php';
require_once 'libs/mallit/Viesti.php';

$aiheenNimi = $_POST['aiheenNimi'];
$viestinTeksti = $_POST['viesti'];
$alue = $_GET['alue'];


if(!empty($aiheenNimi) && empty($viestinTeksti)) {
    naytaNakyma('uusiaihe.php', array('alue' => $alue, 
                                      'virhe' => 'Aloitusviesti ei voi olla tyhjä!',
                                      'aiheenNimi' => $aiheenNimi));
}
if(empty($aiheenNimi) && !empty($viestinTeksti)) {
    naytaNakyma('uusiaihe.php', array('alue' => $alue, 
                                      'virhe' => 'Aiheella on oltava nimi!',
                                      'viesti' => $viestinTeksti));
}

//Lisätään uusi aihe.
if(!empty($aiheenNimi) && !empty($viestinTeksti)) {
    $aihe = new Aihe(null, date('Y-m-d G:i:s'), $alue, $aiheenNimi);
    $aihe->lisaaKantaan();
    
    session_start();
    $postaushetki = date('Y-m-d G:i:s');
    $kirjoittaja = $_SESSION['kirjautunut'];
    $kayttajanNimimerkki = $kirjoittaja->getNimimerkki();
    
    $viesti = new Viesti(-1, $kayttajanNimimerkki, $postaushetki, $viestinTeksti, $aihe->getID());
    $viesti->lisaaKantaan();
    
    
    header('Location: aihe.php?id='.$aihe->getID().'&sivu=1');
}
naytaNakyma('uusiaihe.php', array('alue' => $alue));
