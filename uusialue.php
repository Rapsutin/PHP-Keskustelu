<?php
require_once 'libs/nakyma.php';
require_once 'libs/mallit/Alue.php';
require_once 'libs/mallit/Kayttaja.php';

session_start();
if(!empty($_POST['alueenNimi'])) {
    $alueenNimi = trim($_POST['alueenNimi']);
}
$kirjautunut = $_SESSION['kirjautunut'];
if(!isset($kirjautunut) ||!$kirjautunut->onkoYllapitaja()) {
    $_SESSION['virhe'] = 'Sinun on oltava ylläpitäjä käyttääksesi tätä toimintoa!';
    header('Location: etusivu.php');
    exit();
}

if(isset($alueenNimi)) {
    if(Alue::tarkistaAlueenNimi($alueenNimi) != null) {
        naytaNakyma('uusialue.php', array(  'virhe' => Alue::tarkistaAlueenNimi($alueenNimi),
                                            'nimi' => $alueenNimi));
        exit();
    }
    $uusi = new Alue($alueenNimi);
    $uusi->lisaaKantaan();
    header('Location: alue.php?id='.$uusi->getNimi());
    exit();
}
naytaNakyma('uusialue.php');



