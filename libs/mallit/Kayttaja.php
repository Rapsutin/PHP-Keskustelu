<?php
require_once 'libs/kysely.php';
class Kayttaja {

    private $nimimerkki;
    private $salasana;
    private $viesteja;
    private $liittymisaika;
    private $avatar;
    private $onYllapitaja;

    public function __construct($nimimerkki, $salasana, $viesteja, $liittymisaika, $avatar, $onYllapitaja) {
        $this->nimimerkki = $nimimerkki;
        $this->salasana = $salasana;
        $this->viesteja = $viesteja;
        $this->liittymisaika = $liittymisaika;
        $this->avatar = $avatar;
        $this->onYllapitaja = $onYllapitaja;
    }
    /**
     * @param type $kayttaja
     * @param type $salasana
     * @return type Palauttaa tunnuksia vastaavan käyttäjän. 
     * Jos ei löydy, niin palauttaa null.
     */
    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT 
                    *
                FROM 
                    Kayttaja 
                WHERE
                    nimimerkki = ? AND
                    salasana = ?
                LIMIT 1";
        $kysymysmerkit = array($kayttaja, $salasana);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);

        $tulos = $kysely->fetchObject();
        $kayttaja = Kayttaja::palautaKayttaja($tulos);

        return $kayttaja;
    }
    
    /**
     * @param type $kayttaja Nimimerkki.
     * @param type $salasana
     * @return type Palauttaa nimimerkkiä vastaavan käyttäjän. 
     * Jos ei löydy, niin palauttaa null.
     */
    public static function etsiKayttajaNimimerkilla($kayttaja) {
        $sql = "SELECT *
                FROM 
                    Kayttaja 
                WHERE
                    nimimerkki = ?
                LIMIT 1";
        
        $kysymysmerkit = array($kayttaja);
        $kysely = Kysely::teeKysely($sql, $kysymysmerkit);

        $tulos = $kysely->fetchObject();
        $kayttaja = Kayttaja::palautaKayttaja($tulos);

        return $kayttaja;
    }
    
    /**
     * Palauttaa käyttäjäolion fetchObject-kutsulla
     * saadusta tuloksesta.
     * @param type $tulos fetchObjectin tulos.
     * @return \Kayttaja|null Palauttaa käyttäjä-olion, mutta
     * jos käyttäjää ei löydy kannasta, palautetaan null.
     */
    private static function palautaKayttaja($tulos) {
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja($tulos->nimimerkki, $tulos->salasana, 
                    $tulos->viesteja, $tulos->liittymisaika, $tulos->avatar,
                    $tulos->onyllapitaja);
            return $kayttaja;
        }
    }
    
    /**
     * Päivittää käyttäjän viestilaskuria.
     * @param type $lisattava Negatiivinen luku vähentää viestejä,
     * positiivinen lisää.
     */
    public function lisaaViestilaskuriin($lisattava) {
        $this->viesteja += $lisattava;
        $sql = "UPDATE Kayttaja SET viesteja=? WHERE nimimerkki=?";
        $kysymysmerkit = array($this->viesteja, $this->nimimerkki);
        Kysely::teeKysely($sql, $kysymysmerkit);
    }
    
    public function lisaaKayttajaKantaan() {
        $sql = "INSERT INTO Kayttaja VALUES (?,?,?,?,?,?)";
        $kysmysmerkit = array(  $this->nimimerkki,
                                $this->salasana,
                                $this->viesteja,
                                $this->liittymisaika,
                                $this->avatar,
                                $this->onYllapitaja);
        Kysely::teeKysely($sql, $kysmysmerkit);
    }
    
    public static function tarkistaSalasana($salasana) {
        if (strlen($salasana) < 6) {
            return "Salasanan on oltava vähintään 6 merkkiä!";
        } else if(strlen($salasana) > 20) {
            return "Salasanan on oltava enintään 20 merkkiä!";
        } else {
            return null;
        }
    }
    
    public static function tarkistaKayttajanimi($kayttajanimi) {
        if(strlen($kayttajanimi) < 3) {
            return "Käyttäjänimen on oltava vähintään 3 merkkiä!";
        } else if(strlen($kayttajanimi) > 20) {
            return "Käyttäjänimen on oltava enintään 20 merkkiä!";
        } else {
            return null;
        }
    }
    
    
    public function lisaaYksiViestilaskuriin() {
        $this->lisaaViestilaskuriin(1);
    }
    
    
    public function vahennaYksiViestilaskurista() {
        $this->lisaaViestilaskuriin(-1);
    }

    public function getNimimerkki() {
        return $this->nimimerkki;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function getViesteja() {
        return $this->viesteja;
    }

    public function getLiittymisaika() {
        return $this->liittymisaika;
    }

    public function getAvatar() {
        return $this->avatar;
    }
    
    public function onkoYllapitaja() {
        return $this->onYllapitaja;
    }

    public function setNimimerkki($nimimerkki) {
        $this->nimimerkki = $nimimerkki;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }

    public function setViesteja($viesteja) {
        $this->viesteja = $viesteja;
    }

    public function setLiittymisaika($liittymisaika) {
        $this->liittymisaika = $liittymisaika;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }
    
    public function setOnYllapitaja($boolean) {
        $this->onYllapitaja = $boolean;
    }
    

}

?>
