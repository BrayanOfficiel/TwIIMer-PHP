<?php

require "connexionDB.php";

if (!isset($_SESSION['user'])) {
    header("Location: /connexion.php");
}
$tweet_id = $_POST['tweet_id'];

$requete = "DELETE FROM tweets WHERE id = :tweet";
$requete = $database->prepare($requete);
$requete->execute([
    ":tweet" => $tweet_id
]);


header("Location: /home.php?delete=true");
?>