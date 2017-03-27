<?php
$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\n", $string);
//var_dump($dico);
echo 'Combien de mots contient ce dictionnaire ? : ' . count($dico).'<br />';



$nombreMotsTrouves = 0;
$nombreMotsTrouvesAvecW = 0;
$nombreMotsTrouvesAvecQ = 0;
foreach ($dico as $key => $mot) {
	$tailleMot = strlen($mot);
	if($tailleMot===15){
		$nombreMotsTrouves++;
	}
	$positionW = strpos($mot, 'w');
	if($positionW !== false){
		$nombreMotsTrouvesAvecW++;
	}
	$positionQ = strpos($mot, 'q', strlen($mot)-1);
	if($positionQ !== false){
		$nombreMotsTrouvesAvecQ++;
	}


}
echo "Combien de mots font exactement 15 caractères ? : ".$nombreMotsTrouves."<br/>";
echo "Combien de mots contiennent la lettre « w » ? : ".$nombreMotsTrouvesAvecW."<br/>";
echo 'Combien de mots finissent par la lettre « q » ?'.$nombreMotsTrouvesAvecQ;
?>
