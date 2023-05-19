<?php

session_start();

try {
    $database = new PDO(
        "mysql:host=localhost;dbname=portail_restart",
        //dbType:host;dbName
        "root",
        //id
        "root" //mdp
    );
} catch (PDOException $dbError) {
    die("<h1 style='color:red; font-family:ui-rounded; text-align:center'>Erreur de connexion à la base de données<br><br>Erreur : " . $dbError->getMessage() . "</h1>");
}

?>