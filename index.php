<?php
require "php_includes/connexionDB.php";

if (!isset($_GET['users']) || $_GET['users'] == "") {
    $user_logged = false;
} else {
    $user_logged = true;
    $current_user = $_GET['users'];
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "php_includes/head.php" ?>
    <title>TwIIMer</title>
</head>

<body>

    <?php require "php_includes/nav.php" ?>

    <main class="container">

        <section class="profile-section">
            <div class="profile">
                <h1>
                    <form method="GET">
                        <select class="user_select" name="users" id="">
                            <?php
                            if ($user_logged == true) {
                                echo "<option value='$current_user'>$current_user</option>";
                            } else {
                                echo "<option disabled selected value=''>Choisir un utilisateur</option>";
                            }
                            echo "<option disabled value=''>---------</option>";
                            foreach ($users as $user) {
                                echo "<option value=" . $user['identifiant'] . ">" . $user['identifiant'] . "</option>";
                            }
                            echo "<option disabled value=''>---------</option>";
                            echo "<option value=''>Déconnexion</option>";
                            ?>
                        </select>
                        <button type="submit">Se connecter</button>
                    </form>
                </h1>
                <div>

                </div>
            </div>
        </section>
        <section class="tweet-section">
            <div class='tweet_box'>
                <div class='tweet_header'>
                    <h1 class="tweet_author">
                        <?php
                        if ($user_logged == true) {
                            echo "Bienvenue @$current_user</h1>";
                            echo "le " . date('d/m/Y à H:i');
                        } else {
                            echo "Bienvenue sur TwIIMer, connectez-vous ou inscrivez-vous</h1>";
                        }
                        ?>
                </div>
                <div>

                    <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "tweetVide") {
                            echo "<p class='error'>Veuillez écrire quelque chose</p>";
                        }
                    }
                    ?>
                    <form class="new_tweet" action="php_includes/new_tweet.php" method="post">
                        <input type="hidden" name="user" value="<?= $current_user ?>" id="">
                        <textarea name="tweet" id="tweet" placeholder="Quoi de neuf ?" rows="10"></textarea>
                        <button type="submit">Tweemer</button>
                    </form>
                </div>
            </div>

        </section>


        <hr>

        <section class="tweets_section">
            <div class="tweets-header">
                <h1>Les Tweems</h1>

                <!-- form pour rechercher -->

                <form class="tweet_search" action="php_includes/tweet_search_and_sort.php" method="POST">
                    <input type="hidden" name="user" value="<?= $current_user ?>" id="">
                    <input type="text" name="search" placeholder="Rechercher des tweems">
                    <select name="sort">
                        <option value="recent">Les plus récents</option>
                        <option value="ancien">Les plus anciens</option>
                    </select>
                    <button type="submit">Rechercher</button>
                </form>

            </div>
            <div class="tweets_container">
                <?php
                if (isset($_GET['delete'])) {
                    if ($_GET['delete'] == true) {
                        echo "<p id='tweet_deleted' class='tweet_suppr'>✅&nbsp;&nbsp; Tweet supprimé avec succès</p>";
                    }
                }

                if (isset($_GET['search']) && isset($_GET['sort'])) {
                    $search = $_GET['search'];
                    $sort = $_GET['sort'];
                    $requete = "SELECT * FROM tweets WHERE tweet LIKE '%$search%' ORDER BY date $sort";
                } else {
                    $requete = "SELECT * FROM tweets ORDER BY date DESC";
                }
                $requete = $database->prepare($requete);
                $requete->execute();
                $tweets = $requete->fetchAll(PDO::FETCH_ASSOC);

                foreach ($tweets as $tweet) { ?>
                    <div class='tweet_box'>
                        <div class='tweet_header'>
                            <h1 class="tweet_author">
                                <?= "@" . $tweet['author'] ?>
                            </h1>
                            à tweeté le
                            <?php
                            $date = new DateTime($tweet['date']);
                            echo $date->format('d/m/Y à H:i');
                            ?>
                        </div>
                        <div class='tweet_content'>
                            <?= $tweet['tweet'] ?>
                        </div>
                        <?php
                        if ($user_logged == true) {
                            if ($current_user == $tweet['author']) { ?>
                                <div class='tweet-footer'>
                                    <form action='php_includes/delete_tweet.php' method='post'>
                                        <input type='hidden' name='user' value='<?= $current_user ?>' id=''>
                                        <button name="tweet_id" value="<?= $tweet['id'] ?>" type="submit"
                                            class="delete_tweet">Supprimer</button>
                                    </form>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2023 TwIIMer, Inc.</p>
    </footer>

    <script>
        setTimeout(function () {
            document.getElementById('tweet_deleted').style.animation = 'fadeOut 1s';
        }, 3000);
        setTimeout(function () {
            document.getElementById('tweet_deleted').remove();
        }, 4000);
    </script>
</body>

</html>