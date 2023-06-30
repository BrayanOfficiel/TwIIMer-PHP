<?php
require "php_includes/connexionDB.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "php_includes/head.php" ?>
    <title>Inscription - TwIIMer</title>
</head>

<body>

    <?php require "php_includes/nav.php" ?>

    <main class="container login_container">
        <section>

            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "vide") {
                    echo "<p class='error'>Veuillez remplir tous les champs</p>";
                } else if ($_GET['error'] == "password") {
                    echo "<p class='error'>Les mots de passe ne correspondent pas</p>";
                } else if ($_GET['error'] == "username") {
                    echo "<p class='error'>Ce nom d'utilisateur est déjà pris</p>";
                } else if ($_GET['error'] == "email") {
                    echo "<p class='error'>Cet e-mail est déjà utilisé</p>";
                }
            }
            ?>
            <form class="log_form" method="POST" action="php_includes/inscription_check.php">
                <h2><i class="fa-solid fa-user-pen"></i> Inscription</h2>
                <div>
                    <input required placeholder="Nom" type="text" name="lname">
                    <input required placeholder="Prénom" type="text" name="fname">
                </div>
                <input required placeholder="Identifiant" type="text" name="username">
                <input placeholder="Lien de votre photo de profil (laisser vide pour la photo par défaut)" type="text"
                    name="photo">
                <input required placeholder="e-mail" type="email" name="email">
                <div>
                    <input required placeholder="Mot de passe" type="password" name="password">
                    <input required placeholder="Confirmer le mot de passe" type="password" name="password_confirm">
                </div>
                <button type="submit">S'inscrire</button>
            </form>
        </section>
    </main>
    <script src="/js/script.js"></script>
    <script src="/js/stopScroll.js"></script>
    <script src="/js/localStorage.js"></script>
</body>

</html>