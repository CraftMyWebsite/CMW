<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['menus']['actions']['addLinkMenu'] == true) {
$lectureMenu = new Lire('modele/config/configMenu.yml');
$lectureMenu = $lectureMenu->GetTableau();


$i = count($lectureMenu['MenuTexte']);

$lectureMenu['MenuTexte'][$i] = $_POST['menuTexte'];

if($_POST['methode'] == 1)
	$lectureMenu['MenuLien'][$i] = $_POST['menuLien'];
else
	$lectureMenu['MenuLien'][$i] = '?&page='. urlencode($_POST['page']);
	


$ecriture = new Ecrire('modele/config/configMenu.yml', $lectureMenu);
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