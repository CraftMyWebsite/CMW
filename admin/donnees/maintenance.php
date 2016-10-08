<?php
$req = $bddConnection->query('SELECT maintenanceId, maintenanceMsg, maintenanceEtat, maintenanceMsgAdmin, maintenancePref, maintenanceTime FROM cmw_maintenance WHERE maintenanceId');

$i = 0;

if(!empty($req))
    while($Donnees = $req->fetch())
    {
        $maintenance[$i]['maintenanceId'] = $Donnees['maintenanceId'];
        $maintenance[$i]['maintenanceMsg'] = $Donnees['maintenanceMsg'];
        $maintenance[$i]['maintenanceEtat'] = $Donnees['maintenanceEtat'];
        $maintenance[$i]['maintenanceMsgAdmin'] = $Donnees['maintenanceMsgAdmin'];
        $maintenance[$i]['maintenancePref'] = $Donnees['maintenancePref'];
        $maintenance[$i]['maintenanceTime'] = $Donnees['maintenanceTime'];
        $i++;
    }
?>