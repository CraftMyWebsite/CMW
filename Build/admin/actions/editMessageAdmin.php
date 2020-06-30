<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editAdminMessage'] == true) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceMsgAdmin = :maintenanceMsgAdmin WHERE maintenanceId = :maintenanceId');
	$req->execute(array(
		'maintenanceMsgAdmin' => $_POST['maintenanceMsgAdmin'],
		'maintenanceId' => $_GET['maintenanceId'],
		));
}
?>