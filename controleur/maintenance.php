<?php
$req = $bddConnection->query('SELECT * FROM cmw_maintenance');
$donnees = $req->fetch(PDO::FETCH_ASSOC);
$maintenance[$i] = $donnees;
if($donnees['dateFin'] != 0 && $donnees['dateFin'] <= time()){
	$req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat WHERE maintenanceId = :maintenanceId');
	$req->execute(array('maintenanceEtat' => 0, 'maintenanceId' => $donnees['maintenanceId']));
}
?>