<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['upload']['manage']) {
	$dossier = './theme/upload/panel/';
	$taille_maxi = 10000000;

	$fichier = basename($_FILES['img']['name']);
	$taille = filesize($_FILES['img']['tmp_name']);
	$extensions = array('.ico', '.bmp', '.png', '.gif', '.jpg', '.jpeg');
	$extension = strrchr($_FILES['img']['name'], '.'); 
	if(!in_array($extension, $extensions))
		header ("Refresh: ?page=upload&erreur=1");
	if($taille > $taille_maxi)
		header ("Refresh: ?page=upload&erreur=1");
	if (file_exists($dossier.$fichier))
		header ("Refresh: ?page=upload&erreur=2");
	
	
	$fichier = strtr($fichier, 
		'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
		'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
	if(!move_uploaded_file($_FILES['img']['tmp_name'], $dossier . $fichier))
		header ("Refresh: ?page=upload&erreur=3");
	
	header ("Refresh: ?page=upload");
}?>