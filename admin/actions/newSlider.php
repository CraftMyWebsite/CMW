<?php
$i = count($lectureAccueil['Slider']);
$lectureAccueil['Slider'][$i]['message'] = $_POST['message'];
$lectureAccueil['Slider'][$i]['image'] = $_POST['image'];


$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
?>