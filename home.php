<?php
require "php_includes/connexionDB.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "php_includes/head.php" ?>
    <title>Accueil - TwIIMer</title>
</head>

<body>

    <?php require "php_includes/nav.php" ?>

    <main class="container">
        <section class="tweet-section">
            <div class='tweet_box'>
                <div class='tweet_header'>
                    <h1 class="tweet_author">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "Bienvenue @" . $_SESSION['user']['identifiant'] . "</h1>";
                            echo "le " . date('d/m/Y à H:i');
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
                            <input type="hidden" name="user" value="<?= $_SESSION['user']['identifiant'] ?>" id="">
                            <textarea name="tweet" id="tweet" placeholder="Quoi de neuf ?" rows="10"></textarea>
                            <button type="submit">Tweemer</button>
                        </form>
                    </div>

                    <?php
                        } else {
                            echo "Bienvenue sur TwIIMer, connectez-vous ou inscrivez-vous</h1>";
                            echo '</div>';
                        }
                        ?>

            </div>

        </section>


        <hr>

        <section class="tweets_section">
            <div class="tweets-header">
                <h1>Les Tweems</h1>

                <!-- form pour rechercher et trier-->

                <form class="tweet_search" action="php_includes/tweet_search_and_sort.php" method="POST">
                    <input type="hidden" name="user" value="<?= $_SESSION['user']['identifiant'] ?>" id="">
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
                        if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']['identifiant'] == $tweet['author']) { ?>
                                <div class='tweet-footer'>
                                    <form action='php_includes/delete_tweet.php' method='post'>
                                        <input type='hidden' name='user' value='<?= $_SESSION['user']['identifiant'] ?>' id=''>
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
        <?php
        if (isset($_SESSION['user'])) { ?>
            <div class="quick_tweet">
                <button class="quick_tweet_button"><i class="fa-solid fa-feather"></i></button>
                <div class="quick_tweet_box" style="display: none">
                    <form class="new_tweet" action="php_includes/new_tweet.php" method="post">
                        <input type="hidden" name="user" value="<?= $_SESSION['user']['identifiant'] ?>" id="">
                        <textarea name="tweet" id="tweet" placeholder="Quoi de neuf ?" rows="10"></textarea>
                        <button type="submit">Tweemer</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </main>

    <footer>
        <p>© 2023 TwIIMer, Inc.</p>
        <a href="/landing/index.html">
            Landing Page
        </a>
    </footer>

    <script>
        let tweet_deleted = document.getElementById('tweet_deleted');

        if (tweet_deleted) {
            setTimeout(function () {
                document.getElementById('tweet_deleted').style.animation = 'fadeOut 1s';
            }, 3000);
            setTimeout(function () {
                document.getElementById('tweet_deleted').remove();
            }, 4000);
        }
        const tweetButton = document.querySelector('.quick_tweet_button');
        const tweetBox = document.querySelector('.quick_tweet_box');

        tweetButton.addEventListener('click', () => {
            tweetBox.style.display = (tweetBox.style.display === 'none') ? 'block' : 'none';
        });

    </script>
</body>

</html>