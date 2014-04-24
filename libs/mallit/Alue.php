<?php
require_once 'libs/kysely.php';
require_once 'libs/tietokantayhteys.php';
require_once 'libs/mallit/Aihe.php';
require_once 'libs/mallit/Viesti.php';

class Alue {
    private $nimi;
    public function __construct($nimi) {
        $this->nimi = $nimi;
    }
    
    /**
     * Palauttaa kaikki olemassa olevat alueet.
     * @return \Alue Alueet taulukkona.
     */
    public static function haeKaikkiAlueet() {
        $sql = "SELECT * FROM Alue";
        $kysely = Kysely::teeKysely($sql, array());
        $rivit = $kysely->fetchAll();
        
        $alueet = array();
        foreach($rivit as $rivi) {
            $alueet[] = new Alue($rivi['nimi']);
        }
        return $alueet;
    }
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO Alue VALUES (?)";
        Kysely::teeKysely($sql, array($this->getNimi()));
    }
    
    public static function paivitaKantaan($vanhaNimi, $uusiNimi) {
        Kysely::teeKysely(  'UPDATE Alue SET nimi=? WHERE nimi=?',
                            array($uusiNimi, $vanhaNimi));
    }
    
    public static function poistaAlue($aiheenNimi) {
        Kysely::teeKysely(  'DELETE FROM Alue WHERE nimi = ?',
                            array($aiheenNimi));
    }
    
    public static function tarkistaAlueenNimi($alueenNimi) {
        if(strlen($alueenNimi) > 100) {
            return "Alueen nimessä on ".strlen($alueenNimi)."/100 merkkiä!";
        } else if (strlen($alueenNimi) < 2) {
            return "Alueen nimessä on oltava vähintään 2 kirjainta!";
        }
        return null;
    }
    
    
    public function getAiheitaAlueella() {
        return Aihe::getAiheidenLukumaaraAlueella($this->nimi);
    }
    
    public function getViestejaAlueella() {
        $viesteja = 0;
        $aiheet = Aihe::getAiheetAlueella($this->nimi);
        foreach($aiheet as $aihe) {
            $viesteja += Viesti::montaViestiaAiheessa($aihe->getID());
        }
        return $viesteja;
    }
    public function getNimi() {
        return $this->nimi;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }


    
}

