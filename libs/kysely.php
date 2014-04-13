<?php


class kysely {
    private function __construct() {}
    
    public static function teeKysely($sql, $kysymysmerkit) {
        $yhteys = getTietokantayhteys();
        $kysely = $yhteys->prepare($sql);
        $kysely->execute($kysymysmerkit);
        
        return $kysely;
    }
}

