<?php
if($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'switchInscription')) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET inscription = IF(inscription = 1, 0 ,1) WHERE maintenanceId = :maintenanceId;');
	$req->execute(array(
		'maintenanceId' => $_GET['maintenanceId']
	));
}
?>