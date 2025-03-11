<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../css/dark_mode.css">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP1 - Oefening 2</title>
</head>

<body>
    <h1>Welkom op de pagina van <?= $my_name ?></h1>
    <?php
    for ($i = 1; $i <= 20; $i++) {
        if ($i == $my_age) {
            ?>
            <p>Mijn leeftijd is <?= $i ?> jaar</p> <?php
        } else {
            ?>
            <p>Ik ben niet <?= $i ?> jaar oud</p> <?php
        }
    }
    ?>
    <p>API key: THE_KEY.txt</p>
    <p><a href="../..">ga terug</a></p>
</body>

</html>