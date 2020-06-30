<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['maintenance']['showPage'] == true) {
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