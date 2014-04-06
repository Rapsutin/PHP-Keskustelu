<?php

function onKirjautunut() {
    session_start();
    
    if (isset($_SESSION['kirjautunut'])) {
        return TRUE;
    }
    return FALSE;
}

?>
