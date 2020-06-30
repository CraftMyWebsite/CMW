<?php
if(Permission::getInstance()->verifPerm("createur") && isset($_POST['nom']))
{
	$_Serveur_['General']['createur']['nom'] = htmlspecialchars($_POST['nomCreateur']);
	$_Serveur_['General']['createur']['effets'] = htmlspecialchars($_POST['effetCreateur']);
	$_Serveur_['General']['createur']['prefix'] = htmlspecialchars($_POST['prefixCreateur']);
	$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}