<?php
if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editUploadImg')) {
    unset($_Serveur_['uploadImage']);
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}