<?php

require "connexionDB.php";

if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
}
$tweet_id = $_POST['tweet_id'];
$url = $_POST['url'];

$requete = "DELETE FROM tweets WHERE id = :tweet";
$requete = $database->prepare($requete);
$requete->execute([
    ":tweet" => $tweet_id
]);


header("Location: $url?delete=true");
?>