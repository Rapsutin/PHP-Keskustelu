<?php

require_once '../libs/tietokantayhteys.php';
require_once '../libs/kysely.php';

class Viesti {

    private $id;
    private $kirjoittaja;
    private $kirjoitushetki;
    private $teksti;
    private $aihe;

    public function __construct($id, $kirjoittaja, $kirjoitushetki, $teksti, $aihe) {
        $this->id = $id;
        $this->kirjoittaja = $kirjoittaja;
        $this->kirjoitushetki = $kirjoitushetki;
        $this->teksti = $teksti;
        $this->aihe = $aihe;
    }

    public static function etsiKaikkiViestitAiheesta($aiheID) {
        $sql = "SELECT *
                FROM
                    Viesti
                WHERE
                    aihe = ?
                ORDER BY
                    kirjoitushetki";

        $kysymysmerkit = array($aiheID);

        return Viesti::palautaViesteja($kysymysmerkit, $sql);
    }
    
    public static function palautaYhdenSivunViestit($viestejaSivulla, $sivu, $aiheID) {
        $sql = "SELECT *
                FROM
                    Viesti
                WHERE
                    aihe = ?
                ORDER BY
                    kirjoitushetki
                LIMIT ?
                OFFSET ?";
        $kysymysmerkit = array($aiheID, $viestejaSivulla, ($sivu - 1) * $viestejaSivulla);

        return Viesti::palautaViesteja($kysymysmerkit, $sql);
    }

    public static function montaViestiaAiheessa($aiheID) {
        $sql = "SELECT COUNT(*) as lkm FROM VIESTI WHERE aihe = ?";
        $kysymysmerkit = array($aiheID);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        
        return $kysely->fetchColumn();
    }

    public static function palautaViesteja($kysymysmerkit, $sql) {
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        $rivit = $kysely->fetchAll();
        $viestit = array();
        foreach ($rivit as $viesti) {
            $viestit[] = Viesti::rakennaViestiArraysta($viesti);
        }
        return $viestit;
    }
    
    private static function rakennaViestiArraysta($viesti) {
        return new Viesti(  $viesti['id'], 
                            $viesti['kirjoittaja'], 
                            $viesti['kirjoitushetki'], 
                            $viesti['teksti'], 
                            $viesti['aihe']);
    }
    
    public static function etsiViestiJollaID($id) {
        $sql = "SELECT * FROM Viesti WHERE id = ?";
        $kysymysmerkit = array($id);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        
        $tulos = $kysely->fetchObject();
        $viesti = Viesti::rakennaViestiTuloksesta($tulos);
        return $viesti;
    }
    
    private static function rakennaViestiTuloksesta($tulos) {
        return new Viesti(  $tulos->id, 
                            $tulos->kirjoittaja, 
                            $tulos->kirjoitushetki, 
                            $tulos->teksti, 
                            $tulos->aihe);
    }
    
    public function lisaaKantaan() {
        $sql = "INSERT INTO Viesti(kirjoittaja, kirjoitushetki, teksti, aihe) 
            VALUES(?,?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $ok = $kysely->execute(array(
            $this->kirjoittaja, $this->kirjoitushetki,
            $this->teksti, $this->aihe));
        
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok;
    }
    
    public static function paivitaViesti($id, $teksti) {
        $sql = "UPDATE Viesti SET teksti = ? WHERE id = ?";
        $kysymysmerkit = array($teksti, $id);
        Kysely::teeKysely($sql, $kysymysmerkit);
    }
    
    public static function poistaViesti($id) {
        $sql = "DELETE FROM Viesti WHERE id = ?";
        $kysymysmerkit = array($id);
        kysely::teeKysely($sql, $kysymysmerkit);
    }


    public function onkoKelvollinen() {
        if(strlen($this->teksti) > 0 && strlen($this->teksti) <= 4000) {
            return true;
        }
        return false;
    }

    public function getId() {
        return $this->id;
    }

    public function getKirjoittaja() {
        return $this->kirjoittaja;
    }

    public function getKirjoitushetki() {
        return $this->kirjoitushetki;
    }

    public function getTeksti() {
        return $this->teksti;
    }

    public function getAihe() {
        return $this->aihe;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setKirjoittaja($kirjoittaja) {
        $this->kirjoittaja = $kirjoittaja;
    }

    public function setKirjoitushetki($kirjoitushetki) {
        $this->kirjoitushetki = $kirjoitushetki;
    }

    public function setTeksti($teksti) {
        $this->teksti = $teksti;
    }

    public function setAihe($aihe) {
        $this->aihe = $aihe;
    }

}

?>
