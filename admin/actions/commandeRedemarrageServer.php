<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'info', 'details', 'server')) {
	foreach($jsonCon as $serveur)
	{
		$serveur->restartServer();
	}
}
?>