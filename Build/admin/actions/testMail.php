<?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['actions']['editGeneral']) { 
	require('include/phpmailer/MailSender.php');
	if(MailSender::send($_Serveur_, $_Joueur_['email'], "Test de l'envoie des mails", "Ce <strong>mail</strong> a bien été envoyé !"))
	{
		echo '1';
	} else {
		echo '0';
	}
} ?>