<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editSlider')) {

	$lectureAccueil['Slider']['image'] = $_POST['image'];

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>