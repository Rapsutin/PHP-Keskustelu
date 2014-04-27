<?php

require_once 'libs/tietokantayhteys.php';
require_once 'libs/kysely.php';
require_once 'libs/mallit/Kayttaja.php';

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
    
    /**
     * Palauttaa kaikki viestit aiheesta.
     * @param type $aiheID Aiheen ID.
     * @return type Taulukko viestiolioita.
     */
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
    
    /**
     * Palauttaa yhden sivun viestit taulukkona.
     * @param type $viestejaSivulla Montako viestiä näytetään sivulla.
     * @param type $sivunumero Minkä sivun viestit.
     * @param type $aiheID Aiheen ID.
     * @return type Taulukko viestiolioita.
     */
    public static function palautaYhdenSivunViestit($viestejaSivulla, $sivunumero, $aiheID) {
        $sql = "SELECT *
                FROM
                    Viesti
                WHERE
                    aihe = ?
                ORDER BY
                    kirjoitushetki
                LIMIT ?
                OFFSET ?";
        $kysymysmerkit = array($aiheID, $viestejaSivulla, ($sivunumero - 1) * $viestejaSivulla);

        return Viesti::palautaViesteja($kysymysmerkit, $sql);
    }
    
    /**
     * Kertoo monta viestiä on kirjoitettu aiheeseen.
     * @param type $aiheID Aiheen tunnus
     * @return type Viestien lukumäärä.
     */
    public static function montaViestiaAiheessa($aiheID) {
        $sql = "SELECT COUNT(*) as lkm FROM VIESTI WHERE aihe = ?";
        $kysymysmerkit = array($aiheID);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        
        return $kysely->fetchColumn();
    }
    
    /**
     * Tekee kyselyn annetuilla parametreillä ja palauttaa
     * taulukon viestejä.
     * @param array $kysymysmerkit SQL-kyselyn kysymysmerkit.
     * @param string $sql
     * @return array Viestejä taulukkona.
     */
    public static function palautaViesteja($kysymysmerkit, $sql) {
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);
        $rivit = $kysely->fetchAll();
        $viestit = array();
        foreach ($rivit as $viesti) {
            $viestit[] = Viesti::rakennaViestiArraysta($viesti);
        }
        return $viestit;
    }
    
    public static function rakennaViestiArraysta($viesti) {
        return new Viesti(  $viesti['id'], 
                            $viesti['kirjoittaja'], 
                            $viesti['kirjoitushetki'], 
                            $viesti['teksti'], 
                            $viesti['aihe']);
    }
    
    /**
     * Palauttaa ID:tä vastaavan ID:n.
     * @param int viestin ID
     * @return viestiolio
     */
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
    
    /**
     * Lisää kantaan uuden viestin,
     * joka vastaa oliota.
     */
    public function lisaaKantaan() {
        $sql = "INSERT INTO Viesti(kirjoittaja, kirjoitushetki, teksti, aihe) 
            VALUES(?,?,?,?) RETURNING id";
        $kysely = getTietokantayhteys()->prepare($sql);
        
        $ok = $kysely->execute(array(
            $this->kirjoittaja, $this->kirjoitushetki,
            $this->teksti, $this->aihe));
        
        $kirjoittaja = Kayttaja::etsiKayttajaNimimerkilla($this->kirjoittaja);
        $kirjoittaja->lisaaYksiViestilaskuriin();
        
        if ($ok) {
            $this->id = $kysely->fetchColumn();
        }
        return $ok; //En tarvinne tätä.
    }
    
    /**
     * Päivittää viestin tekstin.
     * @param type $id Viestin ID.
     * @param type $teksti Päivitetty teksti.
     */
    public static function paivitaViesti($id, $teksti) {
        $sql = "UPDATE Viesti SET teksti = ? WHERE id = ?";
        $kysymysmerkit = array($teksti, $id);
        Kysely::teeKysely($sql, $kysymysmerkit);
    }
    
    /**
     * Poistaa kannasta viestin.
     * @param type $id Poistettavan viestin ID.
     */
    public static function poistaViesti($id) {
        $sql = "DELETE FROM Viesti WHERE id = ?";
        $kysymysmerkit = array($id);
        kysely::teeKysely($sql, $kysymysmerkit);
    }

    /**
     * Kertoo onko viesti oikeanmuotoinen.
     * @return boolean TRUE jos oikeanmuotoinen, muuten FALSE.
     */
    public function onkoKelvollinen() {
        if(strlen($this->teksti) > 0 && !Viesti::onkoLiikaaTekstia($this->teksti)) {
            return true;
        }
        return false;
    }
    
    public static function onkoLiikaaTekstia($teksti) {
        if(strlen($teksti) > 4000) {
            return true;
        }
        return false;
    }
    
    public static function liikaaTekstiaVirhe($teksti) {
        return "Viestissä on ".strlen($teksti)."/4000 merkkiä!";
    }
    
    public static function parseroiLainaukset($teksti) {
        $lainaukset = Viesti::erotaLainaukset($teksti);
        $teksti = str_replace($lainaukset, '', $teksti);
        $lainaukset = str_replace(array('(q)', '(/q)'), '', $lainaukset);
        
        foreach($lainaukset as $lainaus) {
            echo "<p style='background-color:LightGray;'><font color='green'>".$lainaus."</font></p>";
        }
        echo $teksti;
    }
    
    public static function erotaLainaukset($teksti) {
        $lainaukset = array();
        $regex = '/\(q\).*?\(\/q\)/s';
        
        preg_match_all($regex, $teksti, $lainaukset);
        
        return $lainaukset[0];
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
