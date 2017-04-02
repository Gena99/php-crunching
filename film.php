<?php

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$listeTop100 = $brut["feed"]["entry"]; # liste de films
$nombreFilmlisteTop100 = count($listeTop100);


echo '<h1>Le Top 100 ITunes</h1>';

echo '<h2>Afficher liste du top 10</h2>';
for ($i=0; $i <10 ; $i++) { 
	$titre = $listeTop100[$i]['title']["label"];
	echo $i+1 . ' ' . $titre . "<br />";
}
echo '<h2>Classement du film Gravity</h2>';
for ($i=0; $i<$nombreFilmlisteTop100 ; $i++) { 
	$titre = $listeTop100[$i]['title']["label"];
	if ($titre === 'Gravity - Alfonso Cuarón') {
		echo 'Position du film dans le top 100 : '.$i;
		# code...
	}
}

echo('<h2>Quels sont les réalisateurs du film The LEGO Movie</h2>');
for($i=0; $i<$nombreFilmlisteTop100 ; $i++) { 
	$titre = $listeTop100[$i]['im:name']["label"];
	if ($titre == 'The LEGO Movie'){
		echo'Les réalisateurs sont : '.$listeTop100[$i]["im:artist"]["label"];


	}
}
echo('<h2> Combien de films sont sortis avant 2000 </h2>');
$nombreDeFilm = 0;
for($i= 0;$i< $nombreFilmlisteTop100; $i++){
	$date = $listeTop100[$i]['im:releaseDate']["label"];
	if(date_parse($date)['year'] < 2000){
		$nombreDeFilm++;		
	}

}
echo 'Nombre de films sortis avant 2000 : '.$nombreDeFilm."<br />";



echo('<h2> Quel est le film le plus ancien ?</h2>');
$lefilmleplusAncien = '';
for($i= 0;$i< $nombreFilmlisteTop100; $i++){
	if($i == 0){
		$lefilmleplusAncien = $listeTop100[$i];
	}else{
		$date = $listeTop100[$i]['im:releaseDate']["label"];
		$dateDufilmleplusAncienPresume = $lefilmleplusAncien['im:releaseDate']["label"];
		if($date < $dateDufilmleplusAncienPresume){
			$lefilmleplusAncien = $listeTop100[$i];
		}
	}
}
echo  "C'est  : ".$lefilmleplusAncien['im:name']["label"] .' ('.$lefilmleplusAncien['im:releaseDate']["attributes"]["label"].')';

echo('<h2> Quel est le film le plus récent ?</h2>');
$lefilmleplusrecent = '';
for($i= 0;$i< $nombreFilmlisteTop100; $i++){
	if($i == 0){
		$lefilmleplusrecent = $listeTop100[$i];
	}else{
		$date = $listeTop100[$i]['im:releaseDate']["label"];
		$dateDufilmleplusRecentPresume = $lefilmleplusrecent['im:releaseDate']["label"];
		if($date > $dateDufilmleplusRecentPresume){
			$lefilmleplusrecent = $listeTop100[$i];
		}
	}
}
echo  "C'est  : ".$lefilmleplusrecent['im:name']["label"] .' ('.$lefilmleplusrecent['im:releaseDate']["attributes"]["label"].')';


echo('<h2> Catégorie la plus représentée </h2>');
$listeCategorie = array();
foreach ($listeTop100 as $key => $film) {
	$categorie = $film['category']['attributes']["label"];
	$listeCategorie [$categorie]++;
}

$categorieLaPlusRepresentee = array('categorie' => '', 'nombre' => 0);
foreach ($listeCategorie as $categorie => $nombre) {
	if ($nombre > $categorieLaPlusRepresentee['nombre']){
		$categorieLaPlusRepresentee = array('categorie' => $categorie, 'nombre' => $nombre);
	}
}
echo 'Catégorie la plus représentée : '.$categorieLaPlusRepresentee['categorie'];


echo('<h2> Réalisateur le plus représenté </h2>');
$listeRealisateurAvecNombreFilm = array();
foreach ($listeTop100 as $key => $film) {
	$realisateur = $film["im:artist"]["label"];
	$listeRealisateurAvecNombreFilm [$realisateur]++;
}
$reaPlusFilm = array('realisateur' => '', 'nombre' => 0);
foreach ($listeRealisateurAvecNombreFilm as $realisateur => $nombre) {
	if ($nombre > $reaPlusFilm['nombre']){
		$reaPlusFilm = array('realisateur' => $realisateur, 'nombre' => $nombre);
	}
}
echo 'Réalisateur le plus représenté : '.$reaPlusFilm['realisateur'];


echo('<h2>Prix d\'achat et location du top 10 des films : </h2>');
$sommeAchat = 0;
$sommeLocation = 0;
for ($i=0; $i <10 ; $i++) { 
	//var_dump($listeTop100[$i]);
	$prixAchat = $listeTop100[$i]['im:price']["attributes"]["amount"];
	$prixLocation = $listeTop100[$i]['im:rentalPrice']["attributes"]["amount"];
	//$sommeAchat = $prixAchat+$sommeAchat;
	$sommeAchat += $prixAchat;
	//$sommeLocation = $prixLocation+$sommeLocation;
	$sommeLocation += $prixLocation;
}
echo 'le prix à l\'achat : $'.$sommeAchat.'<br />';
echo 'le prix à la location : $' .$sommeLocation.'<br />';

echo '<h2>Le mois avec le plus de sorties :</h2>';
$listeDesMoisAvecNbDeFilm = array();
foreach ($listeTop100 as $key => $film){
	$date = $film['im:releaseDate']["label"];
	$mois = date_parse($date)['month'];
	$listeDesMoisAvecNbDeFilm[$mois]++;

} 
$leMoisQuiAPlusDeFilm = array("mois" => 0, 'nombre'=>0);

foreach ($listeDesMoisAvecNbDeFilm as $mois => $nombre) {
	if ($nombre > $leMoisQuiAPlusDeFilm['nombre']){
		$leMoisQuiAPlusDeFilm = array('mois' => $mois, 'nombre' => $nombre);

	}
}
$listeMois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$indexMois = $leMoisQuiAPlusDeFilm['mois']-1;
echo 'le mois ayant plus de sorties au cinéma : '.$listeMois[$indexMois];
















?>