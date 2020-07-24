<?php
if($_Permission_->verifPerm('PermsPanel', 'info', 'details', 'command')) {
	$commandeConsole = str_replace('/', '', $_POST['commandeConsole']);
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->runConsoleCommand($commandeConsole);
	}
}
?>