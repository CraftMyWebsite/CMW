<?php
if($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editUploadImg')) {
    $_Serveur_['uploadImage']['maxFileSize'] = intval($_POST['maxFileSize']);
    $_Serveur_['uploadImage']['maxSize'] = intval($_POST['maxSize']);
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}