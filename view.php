<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/dark_mode.css">
    <title>PROGRAM1 - PHP1</title>
</head>

<body>
    <h1>Hallo welkom bij PHP :)</h1>
    <p>
        Mijn naam is <?= $my_name ?>, en ik zit in klas <?= $my_class ?>. And I am <?= $my_age ?> years old.
    </p>
    <h2>Oefeningen</h2>
    <ul>
        <?php
        for ($i = 1; $i <= $number_of_exercises; $i++):
            ?>
            <li><a href="oefening/<?= $i ?>/">Oefening <?= $i ?></a></li>
        <?php endfor; ?>
    </ul>
</body>

</html>