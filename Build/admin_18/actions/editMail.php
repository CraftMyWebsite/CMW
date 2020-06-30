<?php if(Permission::getInstance()->verifPerm('PermsPanel', 'general', 'actions', 'editGeneral')) { 
	if(isset($_POST['enable']))
	{
		if(isset($_POST['host']))
		{
			$_Serveur_['SMTP']['Host'] = $_POST['host'];
			$_Serveur_['SMTP']['Username'] = htmlspecialchars($_POST['username']);
			$_Serveur_['SMTP']['Password'] = htmlspecialchars($_POST['password']);
			$_Serveur_['SMTP']['Port'] = $_POST['port'];
			$_Serveur_['SMTP']['Protocol'] = $_POST['protocol'];
			$_Serveur_['SMTP']['Footer'] = $_POST['footer'];
			$_Serveur_['SMTP']['From'] = htmlspecialchars($_POST['from']);
			$_Serveur_['SMTP']['Reply'] = htmlspecialchars($_POST['reply']);
		}
	}else {
		unset($_Serveur_['SMTP']);
	}
	$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}
	
		
?>