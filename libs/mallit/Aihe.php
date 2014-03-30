<?php

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
    
    public function getId() {
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