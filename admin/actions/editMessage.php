<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['editDefaultMessage'] == true) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceMsg = :maintenanceMsg WHERE maintenanceId = :maintenanceId');
	$req->execute(array (
		'maintenanceMsg' => $_POST['maintenanceMsg'],
		'maintenanceId' => $_GET['maintenanceId'],
		))
}
?>