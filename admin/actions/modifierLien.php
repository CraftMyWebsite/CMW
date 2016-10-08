<?php
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


?>
