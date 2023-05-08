<?php

require "connexionDB.php";

$lname = $_POST['lname'];
$fname = $_POST['fname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['password_confirm'];

if (empty($photo)) {
    $photo = "/img/profile_500.png";
}

if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    if ($password === $confirm_password) {
        $requete = "SELECT * FROM users WHERE username = :username";
        $requete = $database->prepare($requete);
        $requete->execute([
            ":username" => $username
        ]);
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            $requete_mail = "SELECT * FROM users WHERE email = :email";
            $requete_mail = $database->prepare($requete_mail);
            $requete_mail->execute([
                ":email" => $email
            ]);
            $user_mail = $requete_mail->fetch(PDO::FETCH_ASSOC);
            if (!$user_mail) {
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
                header("Location: /index.php?user=$username");
            } else {
                header("Location: /inscription.php?error=email");
            }
        } else {
            header("Location: /inscription.php?error=username");
        }
    } else {
        header("Location: /inscription.php?error=password");
    }
} else {
    header("Location: /inscription.php?error=vide");
}