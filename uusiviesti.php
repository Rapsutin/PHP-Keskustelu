<?php

require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Viesti.php';
require_once 'libs/mallit/Kayttaja.php';
require_once 'libs/mallit/Luetut.php';
require_once 'libs/kirjautunut.php';

$aiheID = (int) $_GET['aiheID'];
$viesti = trim($_POST['viesti']);
$vastattavanID = $_GET['vastattavanID'];
if(isset($vastattavanID)) {
    $lainattavaViesti = Viesti::etsiViestiJollaID($vastattavanID);
    
}

if (!onKirjautunut()) {
    header("Location: aihe.php?id=" . $aiheID);
}


//Jos viesti on kirjoitettu, niin lisätään se kantaan.
if (!empty($viesti)) {
    session_start();
    $postaushetki = date('Y-m-d G:i:s');
    $kirjoittaja = $_SESSION['kirjautunut'];
    //Päivitetään kirjautuneen käyttäjän tiedot.
    $kirjoittaja = Kayttaja::etsiKayttajaNimimerkilla($kirjoittaja->getNimimerkki());
    $kayttajanNimimerkki = $kirjoittaja->getNimimerkki();


    $viesti = new Viesti(-1, $kayttajanNimimerkki, $postaushetki, $viesti, $aiheID);
    
    if(!$viesti->onkoKelvollinen()) {
        naytaNakyma('uusiviesti.php', array('aihe' => Aihe::getAiheJollaID($aiheID),
                                            'virhe' => Viesti::liikaaTekstiaVirhe($viesti),
                                            'teksti' => $viesti));
        exit();
    }
    $viesti->lisaaKantaan();
    
    
    poistaMerkinnatAiheesta($aiheID);
    header('Location: aihe.php?id=' . $aiheID);
} 

if($_GET['tarkistaViesti'] == 1 && empty($viesti)) {
    naytaNakyma('uusiviesti.php', array('aihe' => Aihe::getAiheJollaID($aiheID),
                                        'virhe' => 'Viesti ei saa olla tyhjä!'));
}



if (isset($_GET['aiheID'])) {
    $aiheID = $_GET['aiheID'];
    $lainaus;
    if(isset($lainattavaViesti)) {
        $lainaus = teeLainaus($lainattavaViesti);
    }
   
    
    naytaNakyma('uusiviesti.php', array('aihe' => Aihe::getAiheJollaID($aiheID),
                                        'teksti' => $lainaus));
} else {
    naytaNakyma('alue.php', array('virhe' => 'Virheellinen URL!'));
}

function teeLainaus($lainattavaViesti) {
    $lainattavaTeksti = $lainattavaViesti->getTeksti();
    $lainauksetTekstissa = Viesti::erotaLainaukset($lainattavaTeksti);
    
    $lainattavaTeksti = str_replace($lainauksetTekstissa, '', $lainattavaTeksti);
    
    $lll = implode('', $lainauksetTekstissa);
    
    return $lll.'(q)'.$lainattavaTeksti.' -'.$lainattavaViesti->getKirjoittaja().'(/q)';
}
?>
