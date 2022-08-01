<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) {
    $_Serveur_['vote']['maxDisplay'] = $_POST['maxDisplay'];
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}