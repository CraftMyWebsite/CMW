<?php
if($_Permission_->verifPerm('PermsPanel', 'info', 'stats', 'members', 'editLimitIp')) {
	$req = $bddConnection->prepare('UPDATE cmw_sysip SET nbrPerIP = :nbrPerIP WHERE id = :id');
	$req->execute(array(
		'nbrPerIP' => $_POST['nbrPerIP'],
		'id' => $_GET['idPerIP'],
		));
}
?>