<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['details']['command'] == true) {
	$commande = str_replace('/', '', $_POST['commande']);
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->runConsoleCommand($commande);
	}
}
?>