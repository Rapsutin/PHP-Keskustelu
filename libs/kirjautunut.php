<?php

/**
 * Kertoo onko käyttäjä kirjautunut palveluun.
 * @return boolean True jos on, muuten false.
 */
function onKirjautunut() {
    session_start();
    
    if (isset($_SESSION['kirjautunut'])) {
        return TRUE;
    }
    return FALSE;
}

?>
