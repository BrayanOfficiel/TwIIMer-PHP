<?php

// Connexion à la base de données
require "connexionDB.php";

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion (pour éviter les anomalies)
if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
}

// On récupère les données du formulaire
$tweet_id = $_POST['tweet_id'];
$url = $_POST['url'];

// On exécute la requête
$requete = "DELETE FROM tweets WHERE id = :tweet";
$requete = $database->prepare($requete);
$requete->execute([
    ":tweet" => $tweet_id
]);

// On redirige vers la page d'accueil avec un message de succès
header("Location: $url?status=SupprSuccess");
?>