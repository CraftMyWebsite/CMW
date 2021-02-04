<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'parametres')) {

    $_Serveur_['General']['moneyName'] = $_POST['moneyName'];


    $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);

}
?>