<?php

require "connexionDB.php";

$user = $_POST['user'];
$tweet_id = $_POST['tweet_id'];

$requete = "DELETE FROM tweets WHERE id = :tweet";
$requete = $database->prepare($requete);
$requete->execute([
    ":tweet" => $tweet_id
]);


header("Location: /index.php?users=$user&tweet_id=$tweet_id&delete=true");
?>