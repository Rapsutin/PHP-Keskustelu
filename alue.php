<?php
require_once 'libs/nakyma.php';
require_once 'libs/mallit/Aihe.php';

naytaNakyma('alue.php', array(  'aiheet' => Aihe::getAiheetAlueella($_GET['id']),
                                'alueID' => $_GET['id']));





