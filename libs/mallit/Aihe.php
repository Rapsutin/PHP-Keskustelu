<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/kysely.php';

class Aihe {

    private $id;
    private $luontiaika;
    private $alue;
    private $nimi;

    function __construct($id, $luontiaika, $alue, $nimi) {
        $this->id = $id;
        $this->luontiaika = $luontiaika;
        $this->alue = $alue;
        $this->nimi = $nimi;
    }
    
    
    public static function getAiheJollaID($id) {
        $sql = "SELECT * FROM Aihe WHERE id = ? LIMIT 1";
        $kysymysmerkit = array($id);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);

        $rivi = $kysely->fetchObject();

        $aihe = new Aihe($rivi->id, $rivi->luontiaika, $rivi->alue, $rivi->nimi);

        return $aihe;
    }
    
    public static  function getAiheetAlueella($alueenNimi) {
        $sql = "SELECT * FROM Aihe WHERE alue = ?";
        $kysymysmerkit = array($alueenNimi);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        
        $rivit = $kysely->fetchAll();
        
        $aiheet = array();
        foreach($rivit as $rivi) {
            $aiheet[] = new Aihe($rivi['id'], $rivi['luontiaika'], $rivi['alue'], $rivi['nimi']);
        }
        return $aiheet;
    }    
    
    /**
     * Lisää aiheen tietokantaan.
     * @return type
     */
    public function lisaaKantaan() {
        
        $sql = "INSERT INTO Aihe(luontiaika, alue, nimi) 
            VALUES(?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $ok = $kysely->execute(array(
            $this->luontiaika,
            $this->alue, $this->nimi));
        
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok; //en tarvinne tätä
    }
    
    /**
     * Päivittää oliota vastaavan monikon
     * olion tietoja vastaaviksi.
     */
    public function paivitaTietokantaan() {
        $sql = 'UPDATE Aihe SET alue = ?, nimi=? WHERE id = ?';
        $kysymysmerkit = array($this->alue, $this->nimi, $this->id);
        Kysely::teeKysely($sql, $kysymysmerkit);
    }
    
    
    

    public function getID() {
        return $this->id;
    }

    public function getLuontiaika() {
        return $this->luontiaika;
    }

    public function getAlue() {
        return $this->alue;
    }

    public function getNimi() {
        return $this->nimi;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLuontiaika($luontiaika) {
        $this->luontiaika = $luontiaika;
    }

    public function setAlue($alue) {
        $this->alue = $alue;
    }

    public function setNimi($nimi) {
        $this->nimi = $nimi;
    }

}

?>
