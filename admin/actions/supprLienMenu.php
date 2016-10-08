<?php 
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


?>
