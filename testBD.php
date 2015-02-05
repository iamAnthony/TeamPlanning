<!DOCTYPE html>
<html lang="fr">

	<head>		
		<meta charset="utf-8">
		<title> Team Planning </title>       
	</head> 

<body> 


<header>
</header>

<nav></nav>
<section>

<p>Hello world !</p>

<?php

$mysqli = new mysqli("localhost", "root", "root", "teamplanning");
if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$res = $mysqli->query("SELECT * FROM USER");

echo "Ordre du jeu de résultats...\n";
$res->data_seek(0);
while ($row = $res->fetch_assoc()) {
    echo " mail = " . $row["mail"] . "\n";
}

?>

</section>

</body></html>
