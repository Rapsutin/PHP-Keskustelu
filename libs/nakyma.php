<?php
/**
 * Näyttää näkymän.
 * @param string $sivu Näkymän tiedosto.
 * @param array $data Näkymälle annettava data.
 */
function naytaNakyma($sivu, $data = array()) {
    $data = (object)$data;
    require 'nakymat/pohja.php';
    exit();
}

