<?php

$lectureMenu = new Lire('modele/config/configMenu.yml');
$lectureMenu = $lectureMenu->GetTableau();


$i = count($lectureMenu['MenuTexte']);

$lectureMenu['MenuTexte'][$i] = $_POST['menuTexte'];

if($_POST['methode'] == 1)
	$lectureMenu['MenuLien'][$i] = $_POST['menuLien'];
else
	$lectureMenu['MenuLien'][$i] = '?&page='. urlencode($_POST['page']);
	


$ecriture = new Ecrire('modele/config/configMenu.yml', $lectureMenu);

?>