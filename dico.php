<?php
$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\n", $string);
//var_dump($dico);
echo 'Combien de mots contient ce dictionnaire ? : ' . count($dico).'<br />';
$nombreMotsTrouves=0;
foreach ($dico as $key => $mot) {
	$tailleMot = strlen($mot);
	if($tailleMot===15){
		$nombreMotsTrouves++;
	}
}
echo "Combien de mots font exactement 15 caractères ? : ".$nombreMotsTrouves;
?>
