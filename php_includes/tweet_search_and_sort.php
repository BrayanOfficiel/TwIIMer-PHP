<?php

require "connexionDB.php";

$search = $_POST['search'];
$sort = $_POST['sort'];
$url = $_POST['url'];
$hashtag = $_POST['hashtag'];

if ($hashtag == "Aucun") {
    $hashtag = "";
}

if ($sort == "ancien") {
    $sort = "ASC";
} else if ($sort == "recent") {
    $sort = "DESC";
} else {
    $sort = "DESC";
}


header("Location: $url?search=$search&sort=$sort&hashtag=$hashtag");

?>