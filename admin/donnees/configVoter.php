<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'showPage')) { 
require('modele/recompenseAuto.class.php');
$reqConfig = $bddConnection->query('SELECT * FROM cmw_votes_recompense_auto_config');
$RecompenseAuto = new RecompenseAuto($bddConnection);
$topRecompense = $RecompenseAuto->getTopRecompenses();
if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', "actions", 'editReset')) { 
	$dateRec = $RecompenseAuto->getDate();
}
}
?>