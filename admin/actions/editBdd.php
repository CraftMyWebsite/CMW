<?php
if ($_Permission_->verifPerm('PermsPanel', 'general', 'actions', 'editGeneral')) {
    if (isset($_POST['adresse']) and isset($_POST['dbNom']) and isset($_POST['dbUtilisateur'])) {
        $_Serveur_['DataBase']['dbAdress'] = $_POST['adresse'];
        $_Serveur_['DataBase']['dbName'] = $_POST['dbNom'];
        $_Serveur_['DataBase']['dbUser'] = $_POST['dbUtilisateur'];
        if (isset($_POST['dbMdp']) && !empty($_POST['dbMdp']) && $_POST['dbMdp'] != '') {
            if ($_POST['dbMdp'] == $_POST['dbMdpconf']) {
                $_Serveur_['DataBase']['dbPassword'] = $_POST['dbMdp'];
            }
        }

        $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
    }
}
?>