<?php
if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editSlider')) {
    unset($lectureAccueil['Slider'][$_GET['id']]);

    $ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}
?>