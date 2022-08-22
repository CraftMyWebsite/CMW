<?php
if($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editInscrMessage')) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceMsgInscr = :maintenanceMsgInscr WHERE maintenanceId = :maintenanceId');
	$req->execute(array(
		'maintenanceMsgInscr' => $_POST['maintenanceMsgInscr'],
		'maintenanceId' => $_GET['maintenanceId'],
		));
}
?>