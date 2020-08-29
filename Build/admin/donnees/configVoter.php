<?php
require('modele/recompenseAuto.class.php');
$reqConfig = $bddConnection->query('SELECT * FROM cmw_votes_recompense_auto_config');
$RecompenseAuto = new RecompenseAuto($bddConnection);
$topRecompense = $RecompenseAuto->getTopRecompenses();
if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', "actions", 'editReset')) { 
	$dateRec = $RecompenseAuto->getDate();
	if(!isset($dateRec))
	{
		$bddConnection->exec('INSERT INTO `cmw_votes_recompense_auto_config`( `type`, `valueType`, `action`) VALUES (3,0,null);');
	}
}
?>