<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'general', 'actions', 'editGeneral')) {
	if(isset($_POST['adresse']) AND isset($_POST['dbNom']) AND isset($_POST['dbUtilisateur']) AND isset($_POST['dbMdp']))
	{
		$_Serveur_['DataBase']['dbAdress'] = $_POST['adresse'];
		$_Serveur_['DataBase']['dbName'] = $_POST['dbNom'];
		$_Serveur_['DataBase']['dbUser'] = $_POST['dbUtilisateur'];
		$_Serveur_['DataBase']['dbPassword'] = $_POST['dbMdp'];

		$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
	}
}
?>