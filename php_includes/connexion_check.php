<!-- log in that assign username to session -->

<?php

require "connexionDB.php";

if (isset($_SESSION['user'])) {
    header("Location: /home.php");
}

$username = $_POST['username'];
$password = $_POST['password'];

// Check if fields are empty
if (empty($username) || empty($password)) {
    header("Location: /connexion.php?error=vide");
    exit();
}

// Check if username exists
$requete = "SELECT * FROM users WHERE identifiant = :username";
$requete = $database->prepare($requete);
$requete->execute([
    ":username" => $username
]);
$result = $requete->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    header("Location: /connexion.php?error=incorrect");
    exit();
}

// Check if password is correct

if ($password != $result['password']) {
    header("Location: /connexion.php?error=incorrect");
    exit();
}

// Assign username to session. sql structure is `id`, `nom`, `prenom`, `identifiant`, `email`, `password`, `photo`, `date`

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