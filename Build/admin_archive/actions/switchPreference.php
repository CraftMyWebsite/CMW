<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenancePref = :maintenancePref WHERE maintenanceId = :maintenanceId');
	$req->execute(array(
		'maintenancePref' => $_POST['maintenancePref'],
		'maintenanceId' => $_GET['maintenanceId'],
		));
}
?>