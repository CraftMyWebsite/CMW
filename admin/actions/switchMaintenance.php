<?php
if ($_Permission_->verifPerm('PermsPanel', 'maintenance', 'actions', 'editEtatMaintenance')) {
    $req_Etat = $bddConnection->query('SELECT maintenanceEtat FROM cmw_maintenance WHERE maintenanceId = 1');
    $get_Etat = $req_Etat->fetch(PDO::FETCH_ASSOC);
    $result_Etat = $get_Etat['maintenanceEtat'];

    if ($result_Etat == '1') {
        $req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat WHERE maintenanceId = :maintenanceId');
        $req->execute(array(
            'maintenanceEtat' => 0,
            'maintenanceId' => $_GET['maintenanceId'],
        ));
        $retour = array('retour' => 'OK', 'etat' => 0);
    } else {
        $date = htmlspecialchars($_POST['date']);
        $dtime = DateTime::createFromFormat('Y-m-d', $date);
        $dateTime = '';
        if ($dtime != false)
            $dateTime = $dtime->getTimestamp();
        if (time() > $dateTime && $dtime != false)
            $retour = array('retour' => 'erreur', 'message' => 'Date de fin avant le début');
        else {
            $req = $bddConnection->prepare('UPDATE cmw_maintenance SET maintenanceEtat = :maintenanceEtat, maintenanceTime = UNIX_TIMESTAMP(), dateFin = :dateFin WHERE maintenanceId = :maintenanceId');
            $req->execute(array(
                'maintenanceEtat' => 1,
                'dateFin' => $dateTime,
                'maintenanceId' => $_GET['maintenanceId'],
            ));
            $retour = array('retour' => 'OK', 'etat' => 1, 'data' => $date);
        }
    }
} else
    $retour = array('retour' => 'erreur', 'message' => 'Erreur de permission');
echo json_encode($retour);
?>