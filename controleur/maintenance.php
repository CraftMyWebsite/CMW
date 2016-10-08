<?php

$req = $bddConnection->prepare('SELECT * FROM cmw_maintenance WHERE maintenanceId');
$req->execute(array(
'maintenanceId' => $maintenance['maintenanceId']));

$donnees = $req->fetch();
$maintenance[$i]['maintenanceId'] = $donnees['maintenanceId'];
$maintenance[$i]['maintenanceMsg'] = $donnees['maintenanceMsg'];
$maintenance[$i]['maintenanceMsgAdmin'] = $donnees['maintenanceMsgAdmin'];
$maintenance[$i]['maintenanceEtat'] = $donnees['maintenanceEtat'];
$maintenance[$i]['maintenancePref'] = $donnees['maintenancePref'];

?>