<?php
if(Permission::getInstance()->verifPerm("createur") && isset($_POST['nom']))
{
	$_Serveur_['General']['joueur'] = htmlspecialchars($_POST['nom']);
	$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
}