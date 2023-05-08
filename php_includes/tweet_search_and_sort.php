<?php

require "connexionDB.php";

$search = $_POST['search'];
$sort = $_POST['sort'];
$user = $_POST['user'];

if ($sort == "ancien") {
    $sort = "ASC";
} else if ($sort == "recent") {
    $sort = "DESC";
} else {
    $sort = "DESC";
}


header("Location: /index.php?search=$search&sort=$sort&users=$user");

?>