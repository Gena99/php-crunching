<?php

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$listeTop100 = $brut["feed"]["entry"]; # liste de films

echo '<h1>Le Top 100 ITunes</h1>';

echo '<h2>Afficher liste du top 10</h2>';
for ($i=0; $i <10 ; $i++) { 
	$titre = $listeTop100[$i]['title']["label"];
	echo $i+1 . ' ' . $titre . "<br />";
}




?>