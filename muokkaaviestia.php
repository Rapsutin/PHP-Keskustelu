<?php
require_once 'libs/nakyma.php';
require_once 'libs/mallit/Viesti.php';
require_once 'libs/mallit/Kayttaja.php';

$viestiID = $_GET['viestiID'];
$aiheID = $_GET['aiheID'];
$poistettava = $_GET['poista'];
$viestinTeksti = trim($_POST['viesti']);
$onkoPainettuLaheta = $_GET['tarkistaViesti'];


$viesti = Viesti::etsiViestiJollaID($viestiID);
session_start();
$kirjoittaja = (object) $_SESSION['kirjautunut'];

if($kirjoittaja->getNimimerkki() != $viesti->getKirjoittaja() && !$kirjoittaja->onkoYllapitaja()) {
    $_SESSION['virhe'] = 'Sinun pitää olla joko viestin kirjoittaja '
            . 'tai ylläpitäjä muokatakasesi viestiä!';
    header('Location: aihe.php?id='.$aiheID);
    exit();
}

//TODO: Tässä pitäisi päivittää viestilaskuria
if(!empty($poistettava)) {
    $poistettavaViesti = Viesti::etsiViestiJollaID($poistettava);
    
    $kirjoittajanNimimerkki = $poistettavaViesti->getKirjoittaja();
    $kirjoittaja = Kayttaja::etsiKayttajaNimimerkilla($kirjoittajanNimimerkki);
    $kirjoittaja->vahennaYksiViestilaskurista();
    
    Viesti::poistaViesti($poistettava);
    header('Location: aihe.php?id='.$aiheID);
    exit();
}

if(!empty($viestinTeksti) && !empty($viestiID)) {
    if(Viesti::onkoLiikaaTekstia($viestinTeksti)) {
        naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID,
                                                'aiheID' => $aiheID,
                                                'teksti' => $viestinTeksti,
                                                'virhe' => Viesti::liikaaTekstiaVirhe($viestinTeksti)));
        exit();
    }
    Viesti::paivitaViesti($viestiID, $viestinTeksti);
    header('Location: aihe.php?id='.$aiheID);
    exit();
}

if(empty($viestinTeksti) && isset($onkoPainettuLaheta)) {
    naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID,
                                            'aiheID' => $aiheID,
                                            'virhe' => 'Viesti ei voi olla tyhjä!'));
}


naytaNakyma('muokkaaviestia.php', array('viestiID' => $viestiID,
                                        'aiheID' => $aiheID));

?>
