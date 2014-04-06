

<?php

require 'nakyma.php';
require 'tietokantayhteys.php';
require 'mallit/Kayttaja.php';
require_once 'kirjautunut.php';


if(onKirjautunut()) {
    naytaNakyma('etusivu.php', array('virhe' => 'Virhe! Olet jo kirjautunut!'));
    
}

if (empty($_POST["nimimerkki"]) && empty($_POST["salasana"])) {
    naytaNakyma('kirjautuminen.php');
}

if (empty($_POST["nimimerkki"])) {
    naytaNakyma("kirjautuminen.php", array(
      'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}

$kayttaja = $_POST["nimimerkki"];


if (empty($_POST["salasana"])) {
    naytaNakyma("kirjautuminen.php", array(
      'kayttaja' => $kayttaja,
      'virhe' => "Kirjautuminen epäonnistui! Et antanut salasanaa.",
    ));
  }
$salasana = $_POST["salasana"];

if(Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana) != NULL) {
    session_start();
    $kayttajaObject = Kayttaja::etsiKayttajaTunnuksilla($kayttaja, $salasana);
    
    $_SESSION['kirjautunut'] = $kayttajaObject;
    header('Location: etusivu.php');
} else {
    naytaNakyma('kirjautuminen.php', 
            array('kayttaja' => $kayttaja,
                'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."));
}

        
?>
