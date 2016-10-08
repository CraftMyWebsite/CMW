<?php

$lectureMenu = new Lire('modele/config/configMenu.yml');
$lectureMenu = $lectureMenu->GetTableau();

$i = count($lectureMenu['MenuTexte']);

$lectureMenu['MenuTexte'][$i] = $_POST['menuTexte'];
$lectureMenu['MenuLien'][$i] = 'null';

$lectureMenu['MenuListeDeroulante'][$_POST['menuTexte']] = Array($_POST['lienTexte']);
$lectureMenu['MenuListeDeroulanteLien'][$_POST['menuTexte']] = Array($_POST['menuLien']);

if($_POST['methode'] == 1)
	$lectureMenu['MenuListeDeroulanteLien'][$_POST['menuTexte']] = Array($_POST['menuLien']);
else
	$lectureMenu['MenuListeDeroulanteLien'][$_POST['menuTexte']] = Array('?&page='. urlencode($_POST['page']));
	
$ecriture = new Ecrire('modele/config/configMenu.yml', $lectureMenu);

?>