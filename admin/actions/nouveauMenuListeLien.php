<?php

require_once('modele/config/yml.class.php');

$lectureMenu = new Lire('modele/config/configMenu.yml');
$lectureMenu = $lectureMenu->GetTableau();
if($lectureMenu['MenuListeDeroulante'][$_POST['listeNum']]['0'] == "LastLinkDontDelete" ) {
	
	$lectureMenu['MenuListeDeroulante'][$_POST['listeNum']]['0'] = $_POST['nomLien'];
	$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']]['0'] = $_POST['menuLien'];	
	
} else {
	
	$lectureMenu['MenuListeDeroulante'][$_POST['listeNum']][] = $_POST['nomLien'];
	$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']][] = $_POST['menuLien'];

}

$ecriture = new Ecrire('modele/config/configMenu.yml', $lectureMenu);

?>
