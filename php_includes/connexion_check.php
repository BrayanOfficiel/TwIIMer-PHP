<!-- log in that assign username to session -->

<?php

// Connexion à la base de données
require "connexionDB.php";

// Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
if (isset($_SESSION['user'])) {
    header("Location: /home.php");
}

// Récupération des données du formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// On vérifie que les champs ne sont pas vides
if (empty($username) || empty($password)) {
    header("Location: /connexion.php?error=vide");
    exit();
}

// On vérifie que l'utilisateur existe
$requete = "SELECT * FROM users WHERE identifiant = :username";
$requete = $database->prepare($requete);
$requete->execute([
    ":username" => $username
]);
$result = $requete->fetch(PDO::FETCH_ASSOC); // On récupère les données de l'utilisateur

// On vérifie que l'utilisateur existe, si le résultat est vide, l'utilisateur n'existe pas
if (!$result) {
    header("Location: /connexion.php?error=incorrect"); // On redirige vers la page de connexion avec un message d'erreur
    exit(); // Arrêt du script
}

// On vérifie que le mot de passe hashé est correct
$hashedPassword = $result['password'];
if (!password_verify($password, $hashedPassword)) { // Si le mot de passe n'est pas correct (password_verify() permet de comparer un mot de passe non hashé entré par l'utilisateur avec son mot de passe hashé stocké dans la base de données)
    header("Location: /connexion.php?error=incorrect"); // On redirige vers la page de connexion avec un message d'erreur
    exit();
}

// On connecte l'utilisateur avec une session et on le redirige vers la page d'accueil
$_SESSION['user'] = array(
    'id' => $result['id'],
    'nom' => $result['nom'],
    'prenom' => $result['prenom'],
    'identifiant' => $result['identifiant'],
    'email' => $result['email'],
    'photo' => $result['photo'],
    'date' => $result['date']
);

header("Location: /home.php");

?>