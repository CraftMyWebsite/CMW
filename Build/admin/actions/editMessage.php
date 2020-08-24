<?php
if($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editDefaultMessage')) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceMsg = :maintenanceMsg WHERE maintenanceId = :maintenanceId');
	$req->execute(array(
		'maintenanceMsg' => $_POST['maintenanceMsg'],
		'maintenanceId' => $_GET['maintenanceId'],
		));
}
?>