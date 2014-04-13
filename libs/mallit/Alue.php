<?php
require_once 'libs/kysely.php';

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
    public function getNimi() {
        return $this->nimi;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }


    
}

