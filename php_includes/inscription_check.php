<?php

// Connexion à la base de données
require "connexionDB.php";

// On récupère les données du formulaire
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$username = $_POST['username'];
$email = $_POST['email'];
$photo = $_POST['photo'];
$password = $_POST['password'];
$confirm_password = $_POST['password_confirm'];

// Si la photo est vide, on lui attribue une photo par défaut
if (empty($photo)) {
    $photo = "/img/profile_500.png";
}

// On vérifie que les champs ne sont pas vides
if (!empty($fname) && !empty($lname) && !empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    // Si les champs ne sont pas vides, on vérifie que les mots de passe correspondent
    if ($password === $confirm_password) {
        $requete = "SELECT * FROM users WHERE identifiant = :username";
        $requete = $database->prepare($requete);
        $requete->execute([
            ":username" => $username
        ]);
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            // Si l'identifiant entré n'est pas déja utilisé, on vérifie l'adresse mail aussi
            $requete_mail = "SELECT * FROM users WHERE email = :email";
            $requete_mail = $database->prepare($requete_mail);
            $requete_mail->execute([
                ":email" => $email
            ]);
            $user_mail = $requete_mail->fetch(PDO::FETCH_ASSOC);
            if (!$user_mail) {
                // Si l'adresse mail n'est pas déja utilisée, on peut inscrire l'utilisateur
                $requete = "INSERT INTO users (identifiant, email, password, nom, prenom, photo) VALUES (:username, :email, :password, :lname, :fname, :photo)";
                $requete = $database->prepare($requete);
                $requete->execute([
                    ":username" => $username,
                    ":email" => $email,
                    ":password" => $password,
                    ":lname" => $lname,
                    ":fname" => $fname,
                    ":photo" => $photo
                ]);
                header("Location: /connexion.php");
            } else {
                session_destroy();
                header("Location: /inscription.php?error=email");
            }
        } else {
            session_destroy();
            header("Location: /inscription.php?error=username");
        }
    } else {
        session_destroy();
        header("Location: /inscription.php?error=password");
    }
} else {
    session_destroy();
    header("Location: /inscription.php?error=vide");
}