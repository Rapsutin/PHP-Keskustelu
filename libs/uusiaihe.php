<?php

require_once 'nakyma.php';
require_once 'mallit/Aihe.php';
require_once 'mallit/Kayttaja.php';
require_once 'mallit/Viesti.php';

if(!empty($_POST['aiheenNimi']) && empty($_POST['viesti'])) {
    naytaNakyma('uusiaihe.php', array('alue' => $_GET['alue'], 
                                      'virhe' => 'Aloitusviesti ei voi olla tyhjä!',
                                      'aiheenNimi' => $_POST['aiheenNimi']));
}
if(empty($_POST['aiheenNimi']) && !empty($_POST['viesti'])) {
    naytaNakyma('uusiaihe.php', array('alue' => $_GET['alue'], 
                                      'virhe' => 'Aiheella on oltava nimi!',
                                      'viesti' => $_POST['viesti']));
}

if(!empty($_POST['aiheenNimi']) && !empty($_POST['viesti'])) {
    $aihe = new Aihe(null, date('Y-m-d G:i:s'), $_GET['alue'], $_POST['aiheenNimi']);
    $aihe->lisaaKantaan();
    
    session_start();
    $postaushetki = date('Y-m-d G:i:s');
    $kirjoittaja = $_SESSION['kirjautunut'];
    $kayttajanNimimerkki = $kirjoittaja->getNimimerkki();
    
    $viesti = new Viesti(-1, $kayttajanNimimerkki, $postaushetki, $_POST['viesti'], $aihe->getID());
    $viesti->lisaaKantaan();
    
    
    header('Location: aihe.php?id='.$aihe->getID().'&sivu=1');
}
naytaNakyma('uusiaihe.php', array('alue' => $_GET['alue']));
