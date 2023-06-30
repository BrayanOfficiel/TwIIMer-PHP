<?php

require "php_includes/connexionDB.php";

if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php require "php_includes/head.php" ?>
    <title>Profil - TwIIMer</title>
</head>

<body>
    <?php require "php_includes/nav.php" ?>
    <main class="container">
        <section class="tweets_section">
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
                <p>Créé le:
                    <?php
                    $date = new DateTime($_SESSION['user']['date']);
                    echo $date->format('d/m/Y à H\hi');
                    ?>
                </p>
                <a href="php_includes/logout.php"><button>Se déconnecter</button></a>
            </div>
            <div class="tweets-header">
                <h1>Les Tweems</h1>

                <!-- Formulaire pour rechercher et trier les tweets -->
                <form class="tweet_search" action="php_includes/tweet_search_and_sort.php" method="POST">
                    <input type="hidden" name="url" value="<?= $url_actuelle ?>">
                    <?php
                    if (isset($_GET['search'])) {
                        $search = $_GET['search'];
                    } else {
                        $search = "";
                    }
                    ?>
                    <input type="text" name="search" value="<?= $search ?>" placeholder="Rechercher des tweems">
                    <select name="hashtag">
                        <?php

                        if (isset($_GET['hashtag']) && !empty($_GET['hashtag'])) {
                            $hashtag = $_GET['hashtag']; ?>
                            <option value='Aucun' disabled>Hashtag</option>
                            <option value='Aucun'>Aucun</option>
                            <option value='<?= $hashtag ?>' selected>#<?= $hashtag ?></option>
                        <?php } else { ?>
                            <option value='Aucun' selected disabled>Hashtag</option>
                            <option value='Aucun'>Aucun</option>
                        <?php } ?>

                        <option value="Aucun" disabled>---------------</option>
                        <option value="Nanterre">#Nanterre</option>
                        <option value="Gaming">#Gaming</option>
                        <option value="Covid">#Covid</option>
                        <option value="Technologie">#Technologie</option>
                        <option value="Sport">#Sport</option>
                        <option value="Politique">#Politique</option>
                        <option value="Musique">#Musique</option>
                        <option value="Cinema">#Cinema</option>
                        <option value="JeuxVideo">#JeuxVideo</option>
                        <option value="Culture">#Culture</option>
                        <option value="Sante">#Sante</option>
                        <option value="Economie">#Economie</option>
                        <option value="Education">#Education</option>
                        <option value="Environnement">#Environnement</option>
                        <option value="Mode">#Mode</option>
                    </select>
                    <select name="sort">
                        <?php
                        if (isset($_GET['sort']) && $_GET['sort'] == "ASC") { ?>
                            <option value='recent'>Les plus récents</option>
                            <option value='ancien' selected>Les plus anciens</option>
                        <?php } else { ?>
                            <option value='recent' selected>Les plus récents</option>
                            <option value='ancien'>Les plus anciens</option>
                        <?php } ?>
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
                if (isset($_GET['search']) && isset($_GET['sort']) && isset($_GET['hashtag'])) {
                    $search = $_GET['search'];
                    $sort = $_GET['sort'];
                    $hashtag = $_GET['hashtag'];
                    $requete = "SELECT * FROM tweets WHERE tweet LIKE '%$search%' AND hashtag LIKE '%$hashtag%' ORDER BY date $sort";
                } else {
                    // On initialise les variables (on en aura besoin après)
                    $search = "";
                    $sort = "DESC";
                    $requete = "SELECT * FROM tweets ORDER BY date DESC";
                }

                // On exécute la requête
                $requete = $database->prepare($requete);
                $requete->execute();
                $tweets = $requete->fetchAll(PDO::FETCH_ASSOC);

                // Si aucun tweet ne correspond à la recherche, on affiche un message
                if (count($tweets) == 0) {
                    echo "<h1>Aucun tweet ne correspond à votre recherche</h1>";
                }
                $i = 0;
                // On affiche les tweets
                foreach ($tweets as $tweet) {
                    ?>
                    <div class='tweet_box'>
                        <div class='tweet_header'>
                            <h1 class="tweet_author">
                                <img src="<?= $tweet['pp'] ?>" alt="" class="pp">
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
                        <?php
                        // Si le tweet contient un hashtag, on l'affiche avec un lien qui va afficher les tweets qui contiennent ce hashtag
                        // On utilise les variables $search et $sort pour garder les paramètres de recherche et de tri
                        if ($tweet['hashtag'] != "Aucun") { ?>
                            <a class="hashtag_link"
                                href="<?= "home.php?search=$search&sort=$sort&hashtag=$tweet[hashtag]" ?>"><?= "#" . $tweet["hashtag"] ?></a>
                        <?php } ?>

                        <!-- On affiche le contenu du tweet -->
                        <div class='tweet_content'>
                            <?= $tweet['tweet'] ?>
                        </div>

                        <!-- Si le tweet contient une image, on l'affiche -->
                        <?php if ($tweet['image'] != "") { ?>
                            <a href="<?= $tweet['image'] ?>"><img src="<?= $tweet['image'] ?>" alt="" class="tweet_image"></a>
                        <?php } ?>
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
        <div class="tweets-header">
            <h1>Vos Tweems</h1>

            <!-- form pour rechercher et trier-->

            <form class="tweet_search" action="php_includes/tweet_search_and_sort.php" method="POST">
                <input type="hidden" name="url" value="<?= $url_actuelle ?>">
                <?php
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                } else {
                    $search = "";
                }
                ?>
                <input type="text" name="search" value="<?= $search ?>" placeholder="Rechercher des tweems">
                <select name="hashtag">
                    <?php

                    if (isset($_GET['hashtag']) && !empty($_GET['hashtag'])) {
                        $hashtag = $_GET['hashtag']; ?>
                        <option value='Aucun' disabled>Hashtag</option>
                        <option value='Aucun'>Aucun</option>
                        <option value='<?= $hashtag ?>' selected>#<?= $hashtag ?></option>
                    <?php } else { ?>
                        <option value='Aucun' selected disabled>Hashtag</option>
                        <option value='Aucun'>Aucun</option>
                    <?php } ?>

                    <option value="Aucun" disabled>---------------</option>
                    <option value="Nanterre">#Nanterre</option>
                    <option value="Gaming">#Gaming</option>
                    <option value="Covid">#Covid</option>
                    <option value="Technologie">#Technologie</option>
                    <option value="Sport">#Sport</option>
                    <option value="Politique">#Politique</option>
                    <option value="Musique">#Musique</option>
                    <option value="Cinema">#Cinema</option>
                    <option value="JeuxVideo">#JeuxVideo</option>
                    <option value="Culture">#Culture</option>
                    <option value="Sante">#Sante</option>
                    <option value="Economie">#Economie</option>
                    <option value="Education">#Education</option>
                    <option value="Environnement">#Environnement</option>
                    <option value="Mode">#Mode</option>
                </select>
                <select name="sort">
                    <?php
                    if (isset($_GET['sort']) && $_GET['sort'] == "ASC") { ?>
                        <option value='recent'>Les plus récents</option>
                        <option value='ancien' selected>Les plus anciens</option>
                    <?php } else { ?>
                        <option value='recent' selected>Les plus récents</option>
                        <option value='ancien'>Les plus anciens</option>
                    <?php } ?>
                </select>
                <button type="submit">Rechercher</button>
            </form>

        </div>
        <div class="tweets_container">
            <?php
            if (isset($_GET['delete'])) {
                if ($_GET['delete'] == true) {
                    echo "<p id='tweet_deleted' class='success'>✅&nbsp;&nbsp; Tweet supprimé avec succès</p>";
                }
            }

            if (isset($_GET['search']) && isset($_GET['sort']) && isset($_GET['hashtag'])) {
                $search = $_GET['search'];
                $sort = $_GET['sort'];
                $hashtag = $_GET['hashtag'];
                $requete = "SELECT * FROM tweets WHERE author = '" . $_SESSION['user']['identifiant'] . "' AND tweet LIKE '%$search%' AND hashtag LIKE '%$hashtag%' ORDER BY date $sort";
            } else {
                $search = "";
                $sort = "DESC";
                $requete = "SELECT * FROM tweets WHERE author = '" . $_SESSION['user']['identifiant'] . "' ORDER BY date DESC";
            }
            $requete = $database->prepare($requete);
            $requete->execute();
            $tweets = $requete->fetchAll(PDO::FETCH_ASSOC);
            $i = 0;
            foreach ($tweets as $tweet) {
                ?>
                <div class='tweet_box'>
                    <div class='tweet_header'>
                        <h1 class="tweet_author">
                            <img src="<?= $tweet['pp'] ?>" alt="" class="pp">
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
                    <?php if ($tweet['hashtag'] != "Aucun") { ?>
                        <a class="hashtag_link" href="<?= "home.php?search=$search&sort=$sort&hashtag=$tweet[hashtag]" ?>"><?= "#" . $tweet["hashtag"] ?></a>
                    <?php } ?>
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

                                        <button name="tweet_id" value="<?= $tweet['id'] ?>" type="submit" class="delete_tweet_true">
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

        <footer>
            ©2023 <a href="index.html" class="title2">TWIIMER</a>
            <span id="footer"></span> - LE réseau social de l'IIM
        </footer>
    </main>
    <?php if (!isset($_SESSION['user'])) { ?>
        <div class="inscr_box" id="inscr_box">
            <div class="box">
                <img src="img/AlertStopIcon.png" alt="">
                Pour continuer a scroll, <a class="hashtag_link" href="connexion.php">connectez-vous</a> ou <a
                    class="hashtag_link" href="inscription.php">inscrivez-vous.</a>
            </div>
        </div>
    <?php }
    if (isset($_GET['delete'])) {
        if ($_GET['delete'] == true) { ?>
            <!-- Notification de suppresison d'un tweet -->
            <p id='tweet_deleted' class='success'>✅&nbsp;&nbsp; Tweet supprimé avec succès</p>
        <?php }
    }
    if (isset($_SESSION['user'])) { ?>
        <!-- Si l'utilisateur est connecté, on affiche un bouton en bas à droite pour tweeter rapidement -->
        <div class="quick_tweet">
            <button id="quick_tweet_button" onclick="showQuickTweet()"><i class="fa-solid fa-feather"></i></button>
            <div id="quick_tweet_box" style="display: none">
                <form class="new_tweet" action="php_includes/new_tweet.php" method="post">
                    <input type="hidden" name="url" value="<?= $url_actuelle ?>">
                    <textarea name="tweet" placeholder="Quoi de neuf ?" rows="10"></textarea>
                    <button type="submit">Tweemer</button>
                </form>
            </div>
        </div>
    <?php } ?>



    <script src="/js/script.js"></script>
    <script src="/js/stopScroll.js"></script>
    <script src="/js/localStorage.js"></script>

    </script>
</body>