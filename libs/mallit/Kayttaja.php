<?php
class Kayttaja {

    private $nimimerkki;
    private $salasana;
    private $viesteja;
    private $liittymisaika;
    private $avatar;

    public function __construct($nimimerkki, $salasana, $viesteja, $liittymisaika, $avatar) {
        $this->nimimerkki = $nimimerkki;
        $this->salasana = $salasana;
        $this->viesteja = $viesteja;
        $this->liittymisaika = $liittymisaika;
        $this->avatar = $avatar;
    }

    public static function etsiKayttajaTunnuksilla($kayttaja, $salasana) {
        $sql = "SELECT 
                    nimimerkki, salasana 
                FROM 
                    Kayttaja 
                WHERE
                    nimimerkki = ? AND
                    salasana = ?
                LIMIT 1";
        $yhteys = getTietokantayhteys();
        $kysely = $yhteys->prepare($sql);
        $kysely->execute(array($kayttaja, $salasana));

        $tulos = $kysely->fetchObject();
        if ($tulos == null) {
            return null;
        } else {
            $kayttaja = new Kayttaja($tulos->nimimerkki, $tulos->salasana, NULL, NULL, NULL);
        }

        return $kayttaja;
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

}

?>
