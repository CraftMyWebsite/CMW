<?php
unset($lectureAccueil['Slider'][$_GET['id']]);

$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
?>