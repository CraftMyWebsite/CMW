<?php 
if($_Permission_->verifPerm('PermsPanel', 'googleService', 'actions', 'adsense')) {

    $_Serveur_['googleService']['adsense']['id']  = $_POST['id'];

    $_Serveur_['googleService']['adsense']['pub']  = $_POST['pub'];

    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}