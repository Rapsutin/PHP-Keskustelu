<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Kayttaja.php';

session_start();

$vanhaSalasana = $_POST['vanhasalasana'];
$uusiSalasana = $_POST['uusisalasana'];
$vahvistaSalasana = $_POST['vahvistasalasana'];
$kuvanURL = $_POST['kuvanURL'];
$kirjautunut = $_SESSION['kirjautunut'];

if(!empty($vanhaSalasana) || !empty($uusiSalasana) || !empty($vahvistaSalasana)) {
    if(empty($vanhaSalasana) || empty($uusiSalasana) || empty($vahvistaSalasana)) {
        naytaNakyma('muokkaaprofiilia.php', array('virhe' => 'Täytä kaikki salasanakentät!'));
        exit();
    } else if(!onkoVanhaSalasanaOikein($kirjautunut, $vanhaSalasana)) {
        naytaNakyma('muokkaaprofiilia.php', array('virhe' => 'Vanha salasana on väärin!'));
        exit();
    } else if($uusiSalasana != $vahvistaSalasana) {
        naytaNakyma('muokkaaprofiilia.php', array('virhe' => 'Salasanan vahvistus on väärin!'));
        exit();
    } else if(Kayttaja::tarkistaSalasana($uusiSalasana) != null) {
        naytaNakyma('muokkaaprofiilia.php', array('virhe' => Kayttaja::tarkistaSalasana($uusiSalasana)));
        exit();
    } else {
        $kirjautunut->paivitaSalasana($uusiSalasana);
        tarkistaOnkoUusiAvatar();
        header('Location: etusivu.php');
        exit();
    }
}
tarkistaOnkoUusiAvatar();

function tarkistaOnkoUusiAvatar() {
    global $kuvanURL, $kirjautunut;
    if($kuvanURL != $kirjautunut->getAvatar() && !empty($kuvanURL)) {
        $kirjautunut->paivitaAvatar($kuvanURL);
        header('Location: etusivu.php');
        exit();
    }
    
}



function onkoVanhaSalasanaOikein($kirjautunut, $vanhaSalasana) {
    if(Kayttaja::etsiKayttajaTunnuksilla($kirjautunut->getNimimerkki(), $vanhaSalasana) == null) {
        return false;
    } else {
        return true;
    }
}



naytaNakyma('muokkaaprofiilia.php');

