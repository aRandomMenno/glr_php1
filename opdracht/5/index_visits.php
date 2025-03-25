<?php

$fileName = "visits.txt";
$visits = 1;

if (file_exists($fileName)) {
	$visits = (int) file_get_contents($fileName);
	$visits++;
}

file_put_contents($fileName, $visits);

$uniqueFileName = "unique_visits.txt";
$uniqueVisits = 1;

if (file_exists($uniqueFileName)) {
	$uniqueVisits = (int) file_get_contents($uniqueFileName);
}

$isNewVisitor = false;
if (!isset($_COOKIE['visited'])) {
	setcookie('visited', 'true', 2147483647, "/");
	$isNewVisitor = true;
}

if ($isNewVisitor) {
	$uniqueVisits++;
	file_put_contents($uniqueFileName, $uniqueVisits);
}

?>

<!DOCTYPE html>
<html>

<head>
	<link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="../../css/dark_mode.css">
	<link rel="stylesheet" href="./css/styles.css">
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PHP1 - Opdracht 5</title>
</head>

<body>
	<h2>Een teller om te kijken hoe vaak de pagina is bezocht.</h2>
	<p>
		Deze pagina is <?= $visits ?> keer bezocht.
	</p>
	<p>
		Deze pagina is door <?= $uniqueVisits ?> unieke bezoekers bekeken.
	</p>
	<p><a href="../..">ga terug</a></p>
</body>

</html>