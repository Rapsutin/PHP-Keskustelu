

<?php

require 'nakyma.php';
require 'tietokantayhteys.php';
require 'mallit/Kayttaja.php';


if (empty($_POST["nimimerkki"]) && empty($_POST["salasana"])) {
    naytaNakyma('kirjautuminen');
}

if (empty($_POST["nimimerkki"])) {
    naytaNakyma("kirjautuminen", array(
      'virhe' => "Kirjautuminen epäonnistui! Et antanut käyttäjätunnusta.",
    ));
}

$kayttaja = $_POST["nimimerkki"];


if (empty($_POST["salasana"])) {
    naytaNakyma("kirjautuminen", array(
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
    naytaNakyma('kirjautuminen', 
            array('kayttaja' => $kayttaja,
                'virhe' => "Kirjautuminen epäonnistui! Antamasi tunnus tai salasana on väärä."));
}

        
?>
