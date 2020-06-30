<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editBackground')) {
	if(isset($_FILES['img']) and !empty($_FILES['img']))
	{
		include_once('controleur/upload.class.php');
		
		$types = Array('png', 'jpg', 'gif');
		
		$copie = new Copie('theme/upload/', $_FILES['img'], 10000000, $types, 2000, 2000);
		$verif = $copie->Verification();
		$copie->SetName('bg.png');
		
		
		if($verif == 4)
			$copie->Copie();
	}
}
if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTypeBackground')) {
	if(isset($_POST['bgType']))
	{
		$lectureAccueil = new Lire('modele/config/config.yml');
		$lectureAccueil = $lectureAccueil->GetTableau();

		$lectureAccueil['General']['bgType'] = $_POST['bgType'];
		
		$ecriture = new Ecrire('modele/config/config.yml', $lectureAccueil);
	}
}
?>