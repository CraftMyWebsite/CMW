<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['editSlider'] == true) {

	$lectureAccueil['Slider']['image'] = $_POST['image'];

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>