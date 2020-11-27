<?php 

if(isset($_GET['id']) && $_Permission_->verifPerm('PermsPanel', 'home', 'actions','editMiniature'))
{
	$lectureAccueil = new Lire('modele/config/accueil.yml');
    $lectureAccueil = $lectureAccueil->GetTableau();

	$id = intval($_GET['id']);

	$flag = 0;
	$last = -1;

	foreach($lectureAccueil['Infos'] as $key => $value)
	{

		if(intval($key) == $id)
		{
			$flag = 1;
			continue;
		}
		if($flag == 1 | $flag == 2) {
			$flag = 2;
			$lectureAccueil['Infos'][intval($key) - 1]['message'] = $lectureAccueil['Infos'][$key]['message'];
			$lectureAccueil['Infos'][intval($key) - 1]['image'] = $lectureAccueil['Infos'][$key]['image'];
			$lectureAccueil['Infos'][intval($key) - 1]['lien'] = $lectureAccueil['Infos'][$key]['lien'];
			$lectureAccueil['Infos'][intval($key) - 1]['type'] = $lectureAccueil['Infos'][$key]['type'];
			$last = intval($key);
		}
	}

	if($flag == 1) {
		unset($lectureAccueil['Infos'][$id]);
	} else if($flag == 2) {
		unset($lectureAccueil['Infos'][$last]);
	}
	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}