<?php
require_once 'libs/tietokantayhteys.php';

class kysely {
    private function __construct() {}
    
    /**
     * Tekee tietokannalle kyselyn.
     * @param type $sql Kyselyn SQL-koodi.
     * @param array $kysymysmerkit SQL-koodin kysymysmerkit.
     * @return type Kyselyn tulos.
     */
    public static function teeKysely($sql, $kysymysmerkit) {
        $yhteys = getTietokantayhteys();
        $kysely = $yhteys->prepare($sql);
        $kysely->execute($kysymysmerkit);
        
        return $kysely;
    }
}

