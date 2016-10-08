<?php 
$id = $_GET['id'];

$menuLecture = new Lire('modele/config/configMenu.yml');
$menuLecture = $configLecture->GetTableau();
if($id != 0)
{
	$interVarT = $menuLecture['MenuTexte'][$id - 1];
	$interVarL = $menuLecture['MenuTexte'][$id - 1];
	
	$menuLecture['MenuLien'][$id - 1] = $menuLecture['MenuLien'][$id];
	$menuLecture['MenuTexte'][$id - 1] = $menuLecture['MenuTexte'][$id];
	
	$menuLecture['MenuLien'][$id] = $interVarL;
	$menuLecture['MenuTexte'][$id] = $interVarT;
}
$ecriture = new Ecrire('modele/config/configMenu.yml', $menuLecture);


?>