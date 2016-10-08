<?php
$commande = str_replace('/', '', $_POST['commande']);
for($i = 0; $i < count($lecture['Json']); $i++)
{
	$jsonCon[$i]->runConsoleCommand($commande);
}
?>