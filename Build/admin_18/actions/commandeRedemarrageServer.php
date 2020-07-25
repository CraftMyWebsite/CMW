<?php
if($_Permission_->verifPerm('PermsPanel', 'info', 'details', 'server')) {
	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->restartServer();
	}
}
?>