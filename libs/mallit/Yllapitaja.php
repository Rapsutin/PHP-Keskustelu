<?php

class Yllapitaja {
    private $nimimerkki;
    private $salasana;
    
    
    public function __construct($nimimerkki, $salasana) {
        $this->nimimerkki = $nimimerkki;
        $this->salasana = $salasana;
    }
    public function getNimimerkki() {
        return $this->nimimerkki;
    }

    public function setNimimerkki($nimimerkki) {
        $this->nimimerkki = $nimimerkki;
    }

    public function getSalasana() {
        return $this->salasana;
    }

    public function setSalasana($salasana) {
        $this->salasana = $salasana;
    }


}

?>
