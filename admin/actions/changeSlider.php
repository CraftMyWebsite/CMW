<?php
for($i = 0; $i < count($lectureAccueil['Slider']); $i++)
{
	$lectureAccueil['Slider'][$i]['message'] = $_POST['message' . $i];
	$lectureAccueil['Slider'][$i]['image'] = $_POST['image' . $i];
}

$lectureAccueil['SliderTitre'] = $_POST['titre'];

$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
?>