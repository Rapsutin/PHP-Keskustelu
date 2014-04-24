

<?php

require 'libs/nakyma.php';
require 'libs/tietokantayhteys.php';
require 'libs/mallit/Kayttaja.php';
require_once 'libs/kirjautunut.php';


if(onKirjautunut()) {
    naytaNakyma('etusivu.php', array('virhe' => 'Virhe! Olet jo kirjautunut!'));
    exit();
}


if (empty($_POST["nimimerkki"]) && empty($_POST["salasana"])) {
    naytaNakyma('kirjautuminen.php');
    exit();
}

if (empty($_POST["nimimerkki"])) {
    naytaNakyma("kirjautuminen.php", array(
      'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
    exit();
}

$kirjoittaja = $_POST["nimimerkki"];


if (empty($_POST["salasana"])) {
    naytaNakyma("kirjautuminen.php", array(
      'kayttaja' => $kirjoittaja,
      'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
    exit();
  }
$salasana = $_POST["salasana"];

//Yritetään kirjautua.
if(Kayttaja::etsiKayttajaTunnuksilla($kirjoittaja, $salasana) != NULL) {
    session_start();
    $kayttajaObject = Kayttaja::etsiKayttajaTunnuksilla($kirjoittaja, $salasana);
    
    $_SESSION['kirjautunut'] = $kayttajaObject;
    header('Location: etusivu.php');
    exit();
} else {
    naytaNakyma('kirjautuminen.php', 
            array('kayttaja' => $kirjoittaja,
                'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."));
    exit();
}

        
?>
