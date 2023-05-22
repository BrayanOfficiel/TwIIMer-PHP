<?php
// Inclusion du script de connexion à la base de données
require "php_includes/connexionDB.php";
?>

<!-- Début du code HTML -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Inclusion du fichier head.php -->
    <?php require "php_includes/head.php" ?>
    <title>Accueil - TwIIMer</title>
</head>

<body>

    <!-- Inclusion du fichier nav.php -->
    <?php require "php_includes/nav.php" ?>

    <main class="container">
        <!-- Section pour tweeter -->
        <section class="tweet-section">
            <div class='tweet_box'>
                <div class='tweet_header'>
                    <h1 class="tweet_author">
                        <?php
                        if (isset($_SESSION['user'])) {
                            echo "Bienvenue @" . $_SESSION['user']['identifiant'] . "</h1>";
                            echo "le " . date('d/m/Y à H:i');
                            ?>
                        </h1>
                    </div>

                    <div>

                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "tweetVide") { ?>
                                <!-- Affichage d'une erreur si le tweet est vide -->
                                <p class='error'>Veuillez écrire quelque chose</p>
                            <?php }
                        }
                        ?>

                        <form class="new_tweet" action="php_includes/new_tweet.php" method="post">
                            <input type="hidden" name="user" value="<?= $_SESSION['user']['identifiant'] ?>">
                            <input type="hidden" name="url" value="<?= $url_actuelle ?>">
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

        <!-- Section pour afficher les tweets -->
        <section class="tweets_section">
            <div class="tweets-header">
                <h1>Les Tweems</h1>

                <!-- Formulaire pour rechercher et trier les tweets -->
                <form class="tweet_search" action="php_includes/tweet_search_and_sort.php" method="POST">
                    <input type="hidden" name="url" value="<?= $url_actuelle ?>">

                    <input type="text" name="search" placeholder="Rechercher des tweems">
                    <select name="sort">
                        <option value="recent">Les plus récents</option>
                        <option value="ancien">Les plus anciens</option>
                    </select>
                    <button type="submit">Rechercher</button>
                </form>
                <div>
                    <button id="grille_btn" class="grid_button" onclick="affichageDesTweetsGrille()"><i
                            class="fa-solid fa-grip"></i></button>
                    <button id="liste_btn" class="grid_button" onclick="affichageDesTweetsListe()"><i
                            class="fa-solid fa-list"></i></button>
                </div>

            </div>
            <div class="tweets_container" id="tweet_container">
                <?php
                // Si une recherche et un tri ont été effectués, on affiche les tweets correspondants, sinon on affiche tous les tweets par ordre décroissant
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
                // On affiche les tweets
                foreach ($tweets as $tweet) {
                    $i = 0;
                    ?>
                    <div class='tweet_box'>
                        <div class='tweet_header'>
                            <h1 class="tweet_author">
                                <?= "@" . $tweet['author'] ?>
                            </h1>
                            <div class="tweet_date">
                                à tweeté le
                                <?php
                                // On affiche la date de création du tweet au format JJ/MM/AAAA à HH:MM
                                $date = new DateTime($tweet['date']);
                                echo $date->format('d/m/Y à H:i');
                                ?>
                            </div>
                        </div>
                        <div class='tweet_content'>
                            <?= $tweet['tweet'] ?>
                        </div>
                        <!-- Si l'utilisateur est connecté et que le tweet lui appartient, on affiche un bouton pour supprimer le tweet -->
                        <?php
                        if (isset($_SESSION['user'])) {
                            if ($_SESSION['user']['identifiant'] == $tweet['author']) { ?>
                                <div class='tweet-footer'>

                                    <button onclick="supprimerTweet(<?= $i ?>, true)" class="delete_tweet"><i
                                            class="fa-solid fa-trash"></i>Supprimer le tweet</button>

                                    <div class="delete_tweet" id="tweet_delete_<?= $i ?>" style="display: none;">

                                        <form action='php_includes/delete_tweet.php' method='post'>
                                            <input type="hidden" name="url" value="<?= $url_actuelle ?>">

                                            <button name="tweet_id" value="<?= $tweet['id'] ?>" type="submit"
                                                class="delete_tweet_true">
                                                <i class="fa-solid fa-check"></i>
                                                Confirmer
                                            </button>
                                        </form>
                                        <button class="delete_tweet_false" onclick="supprimerTweet(<?= $i ?>, false)">
                                            <i class="fa-solid fa-xmark"></i>
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $i++;
                } ?>
            </div>
        </section>


    </main>
    <?php
    if (isset($_GET['delete'])) {
        if ($_GET['delete'] == true) { ?>
            <!-- Notification de suppresison d'un tweet -->
            <p id='tweet_deleted' class='tweet_suppr'>✅&nbsp;&nbsp; Tweet supprimé avec succès</p>
        <?php }
    }
    if (isset($_SESSION['user'])) { ?>
        <!-- Si l'utilisateur est connecté, on affiche un bouton en bas à droite pour tweeter rapidement -->
        <div class="quick_tweet">
            <button id="quick_tweet_button" onclick="showQuickTweet()"><i class="fa-solid fa-feather"></i></button>
            <div id="quick_tweet_box" style="display: none">
                <form class="new_tweet" action="php_includes/new_tweet.php" method="post">
                    <input type="hidden" name="url" value="<?= $url_actuelle ?>">
                    <textarea name="tweet" id="tweet" placeholder="Quoi de neuf ?" rows="10"></textarea>
                    <button type="submit">Tweemer</button>
                </form>
            </div>
        </div>
    <?php } ?>

    <footer>
        <p>© 2023 TwIIMer, Inc.</p>
        <a href="/landing/index.html">
            Landing Page
        </a>
    </footer>

    <script src="/js/script.js"></script>
</body>

</html>