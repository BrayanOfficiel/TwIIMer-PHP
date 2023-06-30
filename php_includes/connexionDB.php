<?php

// On démarre la session
session_start();

// Connexion à la base de données avec PDO
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
// On utilise try/catch pour gérer les erreurs éventuelles, si une erreur se produit, le script s'arrête et affiche le message d'erreur


$url_actuelle = strtok($_SERVER["REQUEST_URI"], '?');
// On récupère l'URL de la page qui le demande et on supprime les paramètres GET (tout ce qui se trouve après le ?) pour ne garder que l'URL de la page

?>