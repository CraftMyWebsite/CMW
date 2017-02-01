<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['editMiniature'] == true) {
	for($i = 0; $i < 3; $i++)
	{
		$lectureAccueil['Infos'][$i]['message'] = $_POST['message' . $i];
		$lectureAccueil['Infos'][$i]['image'] = $_POST['image' . $i];
		if($_POST['typeLien'. $i] == 'page')
			$lectureAccueil['Infos'][$i]['lien'] = '?page='. urlencode($_POST['page' . $i]);
		else 
			$lectureAccueil['Infos'][$i]['lien'] = $_POST['lien' . $i];
	}

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>