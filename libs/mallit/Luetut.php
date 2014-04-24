<?php
require_once 'libs/kysely.php';

function lisaaLuettu($lukija, $luetunAiheID) {
    $sql = "INSERT INTO Luetut VALUES(?, ?)";
    Kysely::teeKysely($sql, array($lukija, $luetunAiheID));
}

function onkoLuettu($lukija, $luetunAiheID) {
    $sql = "SELECT COUNT(*) FROM Luetut WHERE lukija = ? AND aiheID = ?";
    $kysely = Kysely::teeKysely($sql, array($lukija, $luetunAiheID));
    if($kysely->fetchColumn() == 0) {
        return false;
    }
    return true;
}

function poistaMerkinnatAiheesta($aiheID) {
    $sql = "DELETE FROM Luetut WHERE aiheID = ?";
    Kysely::teeKysely($sql, array($aiheID));
}

