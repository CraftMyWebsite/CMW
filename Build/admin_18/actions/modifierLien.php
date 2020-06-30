<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu')) {
	$id = $_GET['id'];

	if($_POST['methode'] == 1)
		$lien = $_POST['menuLien'];	
	else
		$lien = '?page=' .$_POST['page'];


	$menuLecture = new Lire('modele/config/configMenu.yml');
	$menuLecture = $menuLecture->GetTableau();
	$menuLecture['MenuTexte'][$id] = $_POST['texteLien'];
	$menuLecture['MenuLien'][$id] = $lien;


	$ecriture = new Ecrire('modele/config/configMenu.yml', $menuLecture);
	$bugMoche = fopen('modele/config/onfigMenu.yml', 'r+');
	if($bugMoche)
	{
		$i = 0;
		while (($buffer = fgets($bugMoche, 4096)) !== false) {
			$lectureFichier[$i] = $buffer;
			$i++;
		}
		$ecriture = implode('', $lectureFichier);
		$ecriture = preg_replace('#[0-9]+\:#U', '-', $ecriture);
		fclose($bugMoche);
		$bugMoche2 = fopen('modele/config/configMenu.yml', 'w');
		fwrite($bugMoche2, $ecriture);
		fclose($bugMoche2);
	}
	else
		fclose($bugMoche);
}
?>