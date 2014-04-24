<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Alue.php';
require_once 'libs/mallit/Kayttaja.php';

session_start();
$kirjautunut = $_SESSION['kirjautunut'];

if(isset($_POST['alueenNimi'])) {
    $alueenNimi = trim($_POST['alueenNimi']);
}


if(!isset($kirjautunut) || !$kirjautunut->onkoYllapitaja()) {
    $_SESSION['virhe'] = 'Sinun on oltava ylläpitäjä käyttääksesi tätä toimintoa!';
    header('Location: alue.php?id='.$_GET['alueID']);
    exit();
}

if(isset($alueenNimi)) {
    if(Alue::tarkistaAlueenNimi($alueenNimi) != null) {
        naytaNakyma('muokkaaAluetta.php', array('virhe' => Alue::tarkistaAlueenNimi($alueenNimi),
                                                'nimi' => $alueenNimi,
                                                'alueID' => $_GET['alueID']));
        exit();
    }
    Alue::paivitaKantaan($_GET['alueID'], $alueenNimi);
    header('Location: alue.php?id='.$alueenNimi);
    exit();
}

if(isset($_GET['poista'])) {
    Alue::poistaAlue($_GET['poista']);
    header('Location: etusivu.php');
    exit();
}
naytaNakyma('muokkaaAluetta.php', array('alueID' => $_GET['alueID']));

