<?php
 if(!(!$_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editDefaultMessage') AND !$_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editAdminMessage') AND !$_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editEtatMaintenance') AND !$_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'switchRedirectMode') AND !$_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editMessageInscr') AND !$_Permission_->verifPerm('PermsPanel', 'support', 'maintenance', 'actions', 'switchInscriptions'))) {
    $req = $bddConnection->query('SELECT * FROM cmw_maintenance WHERE maintenanceId');

    $i = 0;

    if(!empty($req))
        while($Donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $maintenance[$i] = $Donnees;
            $i++;
        }
    
    }
?>