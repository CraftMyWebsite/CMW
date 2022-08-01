<?php
if ($_Permission_->verifPerm('PermsPanel', 'googleService', 'actions', 'adsense')) {
    require_once('modele/google/googleService.class.php');

    if (googleService::isAdsenseEnable2($_Serveur_)) {
        $_Serveur_['googleService']['adsense']['enable'] = false;
    } else {
        $_Serveur_['googleService']['adsense']['enable'] = true;
    }
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}