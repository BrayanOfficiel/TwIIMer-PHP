<head>
    <?php
    date_default_timezone_set('Europe/Paris');
    $stylesheet = "/style.css?version=" . date("H:i:s_d/m/Y", filemtime('style.css'));
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $stylesheet ?>" />
    <title>IIM Restart - PHP/MySQL</title>
</head>