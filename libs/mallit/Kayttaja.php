<?php
require_once '../libs/kysely.php';
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
    
    public function lisaaYksiViestilaskuriin() {
        $this->viesteja += 1;
        $sql = "UPDATE Kayttaja SET viesteja=? WHERE nimimerkki=?";
        $kysymysmerkit = array($this->viesteja, $this->nimimerkki);
        Kysely::teeKysely($sql, $kysymysmerkit);
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
