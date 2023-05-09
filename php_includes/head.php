<head>
    <?php
    date_default_timezone_set('Europe/Paris');
    $stylesheet = "/style.css?version=" . date("H:i:s_d/m/Y", filemtime('style.css'));
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylesheet ?>" />
    <link rel="stylesheet" href="https://use.typekit.net/awq0vst.css" />
    <link rel="icon" href="/img/logo_400.png" />
</head>