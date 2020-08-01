<?php
if($_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchRedirectMode')) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenancePref = IF(maintenancePref = 1, 0 ,1) WHERE maintenanceId = :maintenanceId;');
	$req->execute(array(
		'maintenanceId' => $_GET['maintenanceId']
	));
}
?>