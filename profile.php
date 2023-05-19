<?php

require "php_includes/connexionDB.php";

if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
    exit;
}

$identifiant = $_SESSION['user']['identifiant'];
$nom = $_SESSION['user']['nom'];
$prenom = $_SESSION['user']['prenom'];
$email = $_SESSION['user']['email'];
$photo = $_SESSION['user']['photo'];
$date = $_SESSION['user']['date'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "php_includes/head.php" ?>
    <title>Profil - TwIIMer</title>
</head>

<body>
    <?php require "php_includes/nav.php" ?>
    <div class="profile_container">
        <img src="<?php echo $_SESSION['user']['photo']; ?>" alt="Profile Picture">
        <h2>
            <?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>
        </h2>
        <p>Identifiant:
            <?php echo $_SESSION['user']['identifiant']; ?>
        </p>
        <p>Email:
            <?php echo $_SESSION['user']['email']; ?>
        </p>
        <p>Date:
            <?php echo $_SESSION['user']['date']; ?>
        </p>
        <a href="php_includes/logout.php"><button>Se déconnecter</button></a>
    </div>
</body>