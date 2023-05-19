<head>
    <?php
    date_default_timezone_set('Europe/Paris');
    $stylesheet = "/css/style.css?version=" . date("s.", filemtime('css/style.css')) . date("s.", filemtime('css/explorer.css')) . date("s.", filemtime('css/nav.css')) . date("s.", filemtime('css/profile.css')) . date("s", filemtime('css/quick_tweet.css'));
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylesheet ?>" />
    <link rel="stylesheet" href="https://use.typekit.net/awq0vst.css" />
    <link rel="icon" href="/img/logo_400.png" />
    <!-- fontawesome css import -->
    <script src="https://kit.fontawesome.com/31dc0750e4.js" crossorigin="anonymous"></script>

</head>