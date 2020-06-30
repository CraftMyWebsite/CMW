<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['actions']['switchRedirectMode'] == true) {
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenancePref = :maintenancePref WHERE maintenanceId = :maintenanceId');
	$req->execute(array(
		'maintenancePref' => $_POST['maintenancePref'],
		'maintenanceId' => $_GET['maintenanceId'],
		));
}
?>