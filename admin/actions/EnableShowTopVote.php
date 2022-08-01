<?php
if ($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) {
    $_Serveur_['vote']['oldDisplay'] = intval($_POST['number']);
    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}