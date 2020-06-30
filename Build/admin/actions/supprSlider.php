<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['editSlider'] == true) {
	unset($lectureAccueil['Slider'][$_GET['id']]);

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>