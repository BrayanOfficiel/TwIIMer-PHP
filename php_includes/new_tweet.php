<?php

if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
}

require "connexionDB.php";

$tweet = $_POST['tweet'];

if (empty($tweet) or $tweet == "") {
    header("Location: /home.php?error=tweetVide");
} else {
    $requete = "INSERT INTO tweets (author, tweet, likes, comments, retweets) VALUES (:author, :tweet, :likes, :comments, :retweets)";
    $requete = $database->prepare($requete);
    $requete->execute([
        ":author" => $_SESSION['user']['identifiant'],
        ":tweet" => $tweet,
        ":likes" => 0,
        ":comments" => 0,
        ":retweets" => 0
    ]);
}

header("Location: /home.php");
?>