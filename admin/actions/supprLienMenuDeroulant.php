<?php 
$id = $_GET['id'];
$id2 = $_GET['id2'];

require_once('modele/config/yml.class.php');

$menuLecture = new Lire('modele/config/configMenu.yml');
$menuLecture = $menuLecture->GetTableau();

if(isset($menuLecture['MenuListeDeroulante'][$menuLecture['MenuTexte'][$id]][$id2]))
{
	if($id2 == 0 AND (!isset($menuLecture['MenuListeDeroulante'][$menuLecture['MenuTexte'][$id]]['1']))) {
		$menuLecture['MenuListeDeroulante'][$menuLecture['MenuTexte'][$id]][$id2] = "LastLinkDontDelete";	
	} else {
		unset($menuLecture['MenuListeDeroulante'][$menuLecture['MenuTexte'][$id]][$id2]);
	}
}
if(isset($menuLecture['MenuListeDeroulanteLien'][$menuLecture['MenuTexte'][$id]][$id2]))
{
	unset($menuLecture['MenuListeDeroulanteLien'][$menuLecture['MenuTexte'][$id]][$id2]);
}

$ecriture = new Ecrire('modele/config/configMenu.yml', $menuLecture);
?>
