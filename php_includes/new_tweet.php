<?php

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion (pour éviter tout comportement anormal)
if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
}

// Connexion à la base de données
require "connexionDB.php";

// Définition de la racine du site sur le pc
$sysLocal = "/Applications/MAMP/htdocs";

// Récupération des données du formulaire
$url = $_POST['url'];
$tweet = $_POST['tweet'];
$hashtag = $_POST['hashtag'];

// Vérification de l'existence d'un hashtag (si le champ est vide, on met "Aucun")
if ($hashtag == "") {
    $hashtag = "Aucun";
}

// UPLOAD IMAGE
$image = $_FILES['image']; // Récupération de l'image

// Vérification de l'existence d'une image
// Si le nom de l'image n'est pas vide
if (!empty($image['name'])) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Extensions autorisées
    $allowedSize = 2; // 2MB

    // Récupération de l'extension de l'image
    // strtolower() permet de mettre l'extension en minuscule, pathinfo() permet de récupérer des informations sur le chemin du fichier, PATHINFO_EXTENSION permet de récupérer l'extension du fichier
    $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    // Si l'extension n'est pas dans le tableau des extensions autorisées, on redirige vers la page d'ajout de tweet avec un message d'erreur
    if (!in_array($extension, $allowedExtensions)) {
        header("Location: $url?error=extension");
        exit;
    }

    // Vérification de la taille de l'image
    if ($image['size'] > $allowedSize * 1024 * 1024) { // 2 * 1024 * 1024 = 2MB car la taille est en octets
        header("Location: $url?error=taille");
        exit;
    }

    // Déplacement de l'image vers le répertoire souhaité
    $imagePath = '/img/uploaded/' . $_SESSION['user']['identifiant'] . "_" . uniqid() . '.' . $extension; // Création d'un nom unique pour l'image avec uniqid() et ajout de l'extension de l'image
    move_uploaded_file($image['tmp_name'], $sysLocal . $imagePath); // Déplacement de l'image vers le répertoire

    $image = $imagePath;
} else {
    // Si l'utilisateur n'a pas ajouté d'image, on met une chaîne de caractères vide
    $image = "";
}

// Vérification de l'existence d'un tweet
if (empty($tweet) or $tweet == "") {
    header("Location: $url?error=tweetVide"); // Si le tweet est vide, on redirige vers la page d'accueil avec un message d'erreur
} else { // Si le tweet n'est pas vide, on l'ajoute à la base de données
    $requete = "INSERT INTO tweets (author, tweet, hashtag, image, likes, comments, retweets, pp) VALUES (:author, :tweet, :hashtag, :image, :likes, :comments, :retweets, :pp)";

    $requete = $database->prepare($requete);
    $requete->execute([
        ":author" => $_SESSION['user']['identifiant'],
        ":tweet" => $tweet,
        ":hashtag" => $hashtag,
        ":image" => $image,
        ":likes" => 0,
        ":comments" => 0,
        ":retweets" => 0,
        ":pp" => $_SESSION['user']['photo']
    ]);
}

header("Location: $url?status=AjoutSuccess"); // Redirection vers la page d'accueil avec un message de succès
?>