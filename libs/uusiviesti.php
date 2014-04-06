<?php
require_once 'nakyma.php';
require_once 'mallit/Aihe.php';
require_once 'mallit/Viesti.php';
require_once 'mallit/Kayttaja.php';
require_once 'kirjautunut.php';


if(!onKirjautunut()) {
    require 'aihe.php';
}

if(!empty($_POST['viesti'])) {
    session_start();
    $postaushetki = date('Y-m-d G:i:s');
    $kayttaja = $_SESSION['kirjautunut'];
    $kayttajanNimimerkki = $kayttaja->getNimimerkki();
    
    $viesti = new Viesti(-1, $kayttajanNimimerkki, $postaushetki, $_POST['viesti'], 1);
    $viesti->lisaaKantaan();
    header('Location: aihe.php');
    
}else if(isset($_GET['aiheID'])) {
   $aiheID = $_GET['aiheID'];
   naytaNakyma('uusiviesti.php', array('aihe' => Aihe::getAiheJollaID($aiheID)));
}
?>
