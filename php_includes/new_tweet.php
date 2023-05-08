<<?php

require "connexionDB.php";

$tweet = $_POST['tweet'];
$user = $_POST['user'];

if (empty($tweet) or $tweet == "") {
    header("Location: /index.php?error=tweetVide");
} else {
    $requete = "INSERT INTO tweets (author, tweet, likes, comments, retweets) VALUES (:author, :tweet, :likes, :comments, :retweets)";
    $requete = $database->prepare($requete);
    $requete->execute([
        ":author" => $user,
        ":tweet" => $tweet,
        ":likes" => 0,
        ":comments" => 0,
        ":retweets" => 0
    ]);
}

header("Location: /index.php?users=$user");
?>