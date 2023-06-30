<?php
// php page that get last tweet and encode it in json

require 'php_includes/connexionDB.php';

$sql = "SELECT * FROM tweets ORDER BY date DESC LIMIT 1";
$requete = $database->prepare($sql);
$requete->execute();
$tweets = $requete->fetchAll(PDO::FETCH_ASSOC)                                                                                                                                                                                                  ;

$json = json_encode($tweets);

echo $json;

?>