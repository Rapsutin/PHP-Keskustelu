<?php
    session_start();
    unset($_SESSION['kirjautunut']);
    header('Location: '. $_SERVER['HTTP_REFERER']);
?>
