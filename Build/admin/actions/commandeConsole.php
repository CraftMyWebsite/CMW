<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'info', 'details', 'command')) {
	$commandeConsole = str_replace('/', '', $_POST['commandeConsole']);
	foreach($jsonCon as $serveur)
	{
		$serveur->runConsoleCommand($commandeConsole);
	}
}
?>