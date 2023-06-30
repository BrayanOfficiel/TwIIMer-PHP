<?php
require "php_includes/connexionDB.php";
if (isset($_SESSION['user'])) {
    header("Location: /home.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "php_includes/head.php" ?>
    <title>Connexion - TwIIMer</title>
</head>

<body>

    <?php require "php_includes/nav.php" ?>

    <main class="container login_container">
        <section>

            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "vide") {
                    echo "<p class='error'>Veuillez remplir tous les champs</p>";
                }
                if ($_GET['error'] == "incorrect") {
                    echo "<p class='error'>L'identifiant ou le mot de passe est incorrect</p>";
                }

            }
            ?>
            <form class="log_form" method="POST" action="php_includes/connexion_check.php">
                <h2><i class="fa-solid fa-user"></i> Connexion</h2>
                <input placeholder="Identifiant" type="text" name="username">
                <input placeholder="Mot de passe" type="password" name="password">
                <button type="submit">Se connecter</button>
            </form>
        </section>
    </main>
    <script src="/js/script.js"></script>
    <script src="/js/stopScroll.js"></script>
    <script src="/js/localStorage.js"></script>
</body>

</html>