<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Kayttaja.php';

$nimimerkki = trim($_POST['uusinimi']);
$salasana = $_POST['uusisalasana'];
$vahvistus = $_POST['vahvistasalasana'];

if (empty($nimimerkki)) {
    naytaNakyma('kirjautuminen.php', array('virhe' => 'Käyttäjänimi ei voi olla tyhjä!'));
    exit();
}
if (empty($salasana)) {
    naytaNakyma('kirjautuminen.php', array( 'virhe' => 'Salasana ei voi olla tyhjä!',
                                            'kayttajanimi' => $nimimerkki));
    exit();
}
if (empty($vahvistus) || $salasana != $vahvistus) {
    naytaNakyma('kirjautuminen.php', array( 'virhe' => 'Salasanat eivät täsmää!',
                                            'kayttajanimi' => $nimimerkki));
    exit();
}


if(is_null(Kayttaja::etsiKayttajaNimimerkilla($nimimerkki))) {
    tarkistaKayttajanimi($nimimerkki);
    tarkistaSalasana($salasana);
    $uusiKayttaja = new Kayttaja(   $nimimerkki, 
                                    $salasana, 
                                    0, 
                                    date('Y-m-d'),
                                    null, 
                                    false);
    $uusiKayttaja->lisaaKayttajaKantaan();
    header('Location: etusivu.php');
    exit();
     
} else {
    naytaNakyma('kirjautuminen.php', array('virhe' => 'Nimi on jo käytössä!'));
    exit();
}


function tarkistaSalasana($salasana) {
    $salasanavirhe = Kayttaja::tarkistaSalasana($salasana);
    if($salasanavirhe != null) {
        naytaNakyma('kirjautuminen.php', array( 'virhe' => $salasanavirhe,
                                                'kayttajanimi' => $nimimerkki));
        exit();
    }
}

function tarkistaKayttajanimi($nimimerkki) {
    $nimivirhe = Kayttaja::tarkistaKayttajanimi($nimimerkki);
    if($nimivirhe != null) {
        naytaNakyma('kirjautuminen.php', array( 'virhe' => $nimivirhe,
                                                'kayttajanimi' => $nimimerkki));
        exit();
    }
}