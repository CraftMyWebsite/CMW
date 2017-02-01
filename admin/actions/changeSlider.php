<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['editSlider'] == true) {
	for($i = 0; $i < count($lectureAccueil['Slider']); $i++)
	{
		$lectureAccueil['Slider'][$i]['message'] = $_POST['message' . $i];
		$lectureAccueil['Slider'][$i]['image'] = $_POST['image' . $i];
	}

	$lectureAccueil['SliderTitre'] = $_POST['titre'];

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>