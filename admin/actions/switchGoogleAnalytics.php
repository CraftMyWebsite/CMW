<?php
if ($_Permission_->verifPerm('PermsPanel', 'googleService', 'actions', 'analytics')) {
    require_once('modele/google/googleService.class.php');

    if (googleService::isAnalyticsEnable2($_Serveur_)) {
        $_Serveur_['googleService']['analytics']['enable'] = false;
    } else {
        $_Serveur_['googleService']['analytics']['enable'] = true;
    }
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}