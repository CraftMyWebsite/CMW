<?php
if($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editSlider')) {

	$lectureAccueil['Slider']['image'] = $_POST['image'];

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>