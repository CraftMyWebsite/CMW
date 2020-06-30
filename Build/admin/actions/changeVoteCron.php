<?php if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) { 

	$_Serveur_['VoteCron']['sendtoall'] = isset($_POST['sendtoall']) ? 1:0;
	$_Serveur_['VoteCron']['msgdeny'] = $_POST['msgdeny'];
	$_Serveur_['VoteCron']['msgallow'] = $_POST['msgallow'];
	$_Serveur_['VoteCron']['footer'] = $_POST['footer'];
	$_Serveur_['VoteCron']['entete'] = $_POST['entete'];
	$_Serveur_['VoteCron']['mdp'] = htmlspecialchars($_POST['mdp']);
	$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
 
}?>