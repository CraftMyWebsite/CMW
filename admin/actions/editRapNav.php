<?php
if($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {
	$lectureAccueil = new Lire('modele/config/accueil.yml');
    $lectureAccueil = $lectureAccueil->GetTableau();
	for($i = 1;$i < count($lectureAccueil['Infos']) + 1;$i++)
	{
		$lectureAccueil['Infos'][$_POST["ordre". $i]]['message'] = $_POST['message' . $i];
		$lectureAccueil['Infos'][$_POST["ordre". $i]]['image'] = $_POST['image' . $i];
		$lectureAccueil['Infos'][$_POST["ordre". $i]]['type'] = $_POST['typeLien'. $i];
		if($_POST['typeLien'. $i] == 'page')
			$lectureAccueil['Infos'][$_POST["ordre". $i]]['lien'] = '?page='. urlencode($_POST['page' . $i]);
		else 
			$lectureAccueil['Infos'][$_POST["ordre". $i]]['lien'] = $_POST['lien' . $i];
	}

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>