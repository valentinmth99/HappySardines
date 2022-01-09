<?php

$bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');

try {
    $bdd = new PDO('mysql:host=localhost;dbname=camping', 'root', '');
    echo "Connecté à la bdd";
}

catch (PDOException $e) {
    echo $e->getMessage();
    die();
}

?>

