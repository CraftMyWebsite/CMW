<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'info', 'details', 'command')) {
	$commande = str_replace('/', '', $_POST['commande']);
	foreach($jsonCon as $serveur)
	{
		$serveur->runConsoleCommand($commande);
	}
}
?>