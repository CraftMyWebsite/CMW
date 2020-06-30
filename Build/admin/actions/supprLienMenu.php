<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['actions']['editDropAndLinkMenu'] == true) {
	$id = $_GET['id'];

	$menuLecture = new Lire('modele/config/configMenu.yml');
	$menuLecture = $menuLecture->GetTableau();

	if(isset($menuLecture['MenuListeDeroulante'][$menuLecture['MenuTexte'][$id]]))
		unset($menuLecture['MenuListeDeroulante'][$menuLecture['MenuTexte'][$id]]);
	if(isset($menuLecture['MenuListeDeroulanteLien'][$menuLecture['MenuTexte'][$id]]))
		unset($menuLecture['MenuListeDeroulanteLien'][$menuLecture['MenuTexte'][$id]]);

	unset($menuLecture['MenuTexte'][$id]);
	unset($menuLecture['MenuLien'][$id]);

	$ecriture = new Ecrire('modele/config/configMenu.yml', $menuLecture);
	$bugMoche = fopen('modele/config/configMenu.yml', 'r+');
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