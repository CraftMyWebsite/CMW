<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['details']['command'] == true) {
	$commandeConsole = str_replace('/', '', $_POST['commandeConsole']);
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->runConsoleCommand($commandeConsole);
	}
}
?>