<?php
$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\n", $string);
//var_dump($dico);
echo 'nombre de mots dans le dictionnaire : ' . count($dico);

?>

