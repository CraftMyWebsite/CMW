﻿<?php
if($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editAdminMessage')) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceMsgAdmin = :maintenanceMsgAdmin WHERE maintenanceId = :maintenanceId');
	$req->execute(array(
		'maintenanceMsgAdmin' => $_POST['maintenanceMsgAdmin'],
		'maintenanceId' => $_GET['maintenanceId'],
		));
}
?>