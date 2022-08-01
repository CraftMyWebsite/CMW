<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) {
    unset($_Serveur_['vote']['oldDisplay']);
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}