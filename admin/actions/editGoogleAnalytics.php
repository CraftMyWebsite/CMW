<?php 
if($_Permission_->verifPerm('PermsPanel', 'googleService', 'actions', 'analytics')) {

    $_Serveur_['googleService']['analytics']['id']  = $_POST['id'];

    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}