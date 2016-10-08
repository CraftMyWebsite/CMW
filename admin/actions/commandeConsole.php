<?php
$commandeConsole = str_replace('/', '', $_POST['commandeConsole']);
for($i = 0; $i < count($lecture['Json']); $i++)
{
	$jsonCon[$i]->runConsoleCommand($commandeConsole);
}
?>