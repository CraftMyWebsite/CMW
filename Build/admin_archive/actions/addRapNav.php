<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {
		$lectureAccueil['Infos'][$_POST["ordre"]]['message'] = $_POST['message'];
		$lectureAccueil['Infos'][$_POST["ordre"]]['image'] = $_POST['image'];
		if($_POST['typeLien'] == 'page')
			$lectureAccueil['Infos'][$_POST["ordre"]]['lien'] = '?page='. urlencode($_POST['page']);
		else 
			$lectureAccueil['Infos'][$_POST["ordre"]]['lien'] = $_POST['lien'];

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>