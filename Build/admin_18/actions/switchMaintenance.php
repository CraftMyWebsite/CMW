<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'editEtatMaintenance')) {
	$req_Etat = $bddConnection->query('SELECT maintenanceEtat FROM cmw_maintenance WHERE maintenanceId = 1');
	$get_Etat = $req_Etat->fetch(PDO::FETCH_ASSOC);
	$result_Etat = $get_Etat['maintenanceEtat'];
	
	if($result_Etat == "1") {
			$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat WHERE maintenanceId = :maintenanceId');
			$req->execute(array (
				'maintenanceEtat' => 0,
				'maintenanceId' => $_GET['maintenanceId'],
				));
	} else {
		$date = htmlspecialchars($_POST["date"]);
		$dtime = DateTime::createFromFormat("d/m/Y H:i", $date);
		$dateTime = "";
		if($dtime != false)
			$dateTime = $dtime->getTimestamp();
		
		$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat, maintenanceTime = UNIX_TIMESTAMP(), dateFin = :dateFin WHERE maintenanceId = :maintenanceId');
		$req->execute(array (
			'maintenanceEtat' => 1,
			'dateFin' => $dateTime,
			'maintenanceId' => $_GET['maintenanceId'],
		));
	}
}
?>