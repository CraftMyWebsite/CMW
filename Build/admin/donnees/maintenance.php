<?php
 if($_Permission_->verifPerm('PermsPanel',"maintenance","showPage")) {
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