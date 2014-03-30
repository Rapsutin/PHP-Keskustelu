<?php

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
