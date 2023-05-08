<?php

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

$requete_users = "SELECT * FROM users";
$requete_users = $database->prepare($requete_users);
$requete_users->execute();
$users = $requete_users->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['users']) && !empty($_GET['users'])) {
    $get_user = "SELECT * FROM users WHERE identifiant = :username";
    $get_user = $database->prepare($get_user);
    $get_user->execute([
        ":username" => $_GET['users']
    ]);
    $get_user_data = $get_user->fetch(PDO::FETCH_ASSOC);
}

?>