<?php
if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu')) {

$lectureMenu = new Lire('modele/config/configMenu.yml');
$lectureMenu = $lectureMenu->GetTableau();
if($lectureMenu['MenuListeDeroulante'][$_POST['listeNum']]['0'] == "LastLinkDontDelete" ) {
	
	if($_POST['methode'] == 1) {
		$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']]['0'] = $_POST['menuLien'];
	} else if($_POST['methode'] == 2) {
		$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']]['0'] = "?page=".$_POST['page'];
	} else {
		$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']]['0'] = "-divider-";
	}
	$lectureMenu['MenuListeDeroulante'][$_POST['listeNum']]['0'] = $_POST['nomLien'];
	
} else {
	
	$lectureMenu['MenuListeDeroulante'][$_POST['listeNum']][] = $_POST['nomLien'];
	if($_POST['methode'] == 1) {
		$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']][] = $_POST['menuLien'];
	} else if($_POST['methode'] == 2) {
		$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']][] = "?page=".$_POST['page'];
	} else {
		$lectureMenu['MenuListeDeroulanteLien'][$_POST['listeNum']][] = "-divider-";
	}

}

$ecriture = new Ecrire('modele/config/configMenu.yml', $lectureMenu);

}
?>