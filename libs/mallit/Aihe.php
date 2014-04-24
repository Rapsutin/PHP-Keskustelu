<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/mallit/Viesti.php';
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
    
    public static function getAiheetAlueella($alueenNimi) {
        $sql = "SELECT * FROM Aihe WHERE alue = ?";
        $kysymysmerkit = array($alueenNimi);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        
        $rivit = $kysely->fetchAll();
        
        $aiheet = array();
        foreach($rivit as $rivi) {
            $aiheet[] = new Aihe($rivi['id'], $rivi['luontiaika'], $rivi['alue'], $rivi['nimi']);
        }
        usort($aiheet, array("Aihe", "vertaaAiheenViimeisimmanViestinKirjoitusaikaa"));
        return $aiheet;
    } 
    
    public static function vertaaAiheenViimeisimmanViestinKirjoitusaikaa($aihe1, $aihe2) {
        return Aihe::vertaaViestinKirjoitusaikaa($aihe1->getViimeisinViesti(),
                                    $aihe2->getViimeisinViesti());
    }
    
    private static function vertaaViestinKirjoitusaikaa($viesti1, $viesti2) {
        $kirjoitushetki1 = strtotime($viesti1->getKirjoitushetki());
        $kirjoitushetki2 = strtotime($viesti2->getKirjoitushetki());
        
        return $kirjoitushetki2 - $kirjoitushetki1;
    }
    
    public static function getAiheidenLukumaaraAlueella($alue) {
        $sql = "SELECT COUNT(*) FROM Aihe WHERE Alue = ?";
        $kysymysmerkit = array($alue);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        
        return $kysely->fetchColumn();
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
    
    public function poistaTietokannasta() {
        $sql = "DELETE FROM Aihe WHERE id = ?";
        $kysymysmerkit = array($this->id);
        Kysely::teeKysely($sql, $kysymysmerkit);
    }
   
    public function getViimeisinViesti() {
        $sql = "SELECT * "
             . "FROM Viesti "
             . "WHERE aihe = ? "
             . "ORDER BY kirjoitushetki desc "
             . "LIMIT 1";
        $kysely = Kysely::teeKysely($sql, array($this->id));
        $rivi = $kysely->fetch();
        $viesti = Viesti::rakennaViestiArraysta($rivi);
        return $viesti;
    }
    
    public static function tarkistaNimi($nimi) {
        if(strlen($nimi) > 100) {
            return "Aiheen nimessä on ".strlen($nimi)."/100 merkkiä!";
        } else if(strlen($nimi) < 2){
            return "Aiheen nimessä on oltava vähintään 2 merkkiä!";
        } else {
            return null;
        }
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
