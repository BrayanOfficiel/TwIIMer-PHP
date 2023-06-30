<!-- mettre à jour le css principal après modification de chaque composant css pour éviter de reset le cache -->
<?php
date_default_timezone_set('Europe/Paris');
$stylesheet = "/css/style.css?version=" . date("s.", filemtime('css/style.css')) . date("s.", filemtime('css/tweets.css')) . date("s.", filemtime('css/nav.css')) . date("s.", filemtime('css/profile.css')) . date("s", filemtime('css/quick_tweet.css'));
$stylesheet_min = "/css/style_min.css?version=" . date("s.", filemtime('css/style_min.css'));
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- css updaté -->
<link rel="stylesheet" href="<?= $stylesheet ?>" />
<!-- police titre -->
<link rel="stylesheet" href="https://use.typekit.net/awq0vst.css" />
<!-- favicon -->
<link rel="icon" href="/img/logo_400.png" />
<!-- fontawesome css import -->
<script src="https://kit.fontawesome.com/31dc0750e4.js" crossorigin="anonymous"></script>