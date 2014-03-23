<?php
require_once "tietokantayhteys.php"; 

class Kayttaja {
    private $tunnus;
    private $password;

    public function __construct($tunnus, $salasana) {
        $this->tunnus = $tunnus;
        $this->salasana = $salasana;
    }

    public static function etsiKaikkiKayttajat() {
        $sql = "SELECT nimimerkki, salasana FROM Kayttaja";
        $kysely = getTietokantayhteys()->prepare($sql);
        $kysely->execute();
        
        return $kysely;
    }
    
   
}
?>