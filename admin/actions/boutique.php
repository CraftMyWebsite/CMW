<?php
if ($_Permission_->verifPerm('PermsPanel', 'shop', 'parametres')) {

    $_Serveur_['General']['moneyName'] = $_POST['moneyName'];
    $_Serveur_['Payement']['currency'] = $_POST['currency'];

    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);

}
?>