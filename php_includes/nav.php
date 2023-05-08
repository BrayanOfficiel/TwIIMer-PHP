<nav>
    <a class="nav_logo" href="index.php">
        <img class="logo" src="img/logo_400.png" alt="logo">
        <h1 class="logo_text">TwIIMer</h1>
    </a>
    <ul class="nav_list">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="explorer.php">Explorer</a></li>
        <li><a href="notifications.php">Notifications</a></li>
        <li><a href="messagerie.php">Messagerie</a></li>
        <li><a href="signets.php">Signets</a></li>
        <li>
            <hr>
        </li>
        <li>
            <?php
            if (isset($_GET['users']) && !empty($_GET['users'])) {

                echo "<a><img style='margin-right: 10px' width='20' src=" . $get_user_data["photo"] . ">" . $get_user_data["identifiant"] . "</a>";
            }
            echo "";
            ?>
        </li>
        <li><a href='inscription.php'>S'inscrire</a></li>
    </ul>
</nav>