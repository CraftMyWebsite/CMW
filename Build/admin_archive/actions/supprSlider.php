<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editSlider')) {
	unset($lectureAccueil['Slider'][$_GET['id']]);

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>