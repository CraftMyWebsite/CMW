<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['details']['server'] == true) {
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->reloadServer();
	}
}
?>