<?php
if($_Permission_->verifPerm('PermsPanel', 'upload', 'manage')) {
	$dossier = './theme/upload/panel/';
	$taille_maxi = 10000000;

	$fichier = $_FILES['img']['name'];
	$taille = $_FILES['img']['size'];
	$extensions = array('ico', 'bmp', 'png', 'gif', 'jpg', 'jpeg');
	$extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
	if(!in_array(strtolower($extension), $extensions))
	{
		header ("location: admin.php?page=upload&erreur=0");
		exit();
	}
	if($taille > $taille_maxi)
	{
		header ("location: admin.php?page=upload&erreur=1");
		exit();
	}
	if (file_exists($dossier.$fichier))
	{
		header ("location: admin.php?page=upload&erreur=2");
		exit();
	}
	
	
	$fichier = strtr($fichier, 
		'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
		'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
	if(!move_uploaded_file($_FILES['img']['tmp_name'], $dossier . $fichier))
	{
		header ("location: admin.php?page=upload&erreur=3");
		exit();
	}
	
	header ("location: admin.php?page=upload&success");
	exit();
}?>