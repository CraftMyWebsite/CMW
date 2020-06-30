<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'general', 'actions', 'editGeneral')) {
	if(isset($_POST['adresseWeb']) AND isset($_POST['nom']) AND isset($_POST['description']))
	{
		$_Serveur_['General']['url'] = $_POST['adresseWeb'];
		$_Serveur_['General']['name'] = $_POST['nom'];
		$_Serveur_['General']['description'] = $_POST['description'];
		$_Serveur_['General']['ipTexte'] = $_POST['ipTexte'];
		$_Serveur_['General']['ip'] = $_POST['ip'];
		$_Serveur_['General']['port'] = $_POST['port'];
		$_Serveur_['General']['statut'] = $_POST['statut'];

		$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
	}
}
?>