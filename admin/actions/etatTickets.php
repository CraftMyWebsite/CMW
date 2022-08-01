<?php
if ($_Permission_->verifPerm('PermsPanel', 'support', 'tickets', 'actions', 'editEtatTicket')) {
    $req = $bddConnection->prepare('UPDATE cmw_support SET etat = IF(etat = 0, 1,0) WHERE id = :id');
    $req->execute(array(
        'id' => $_GET['id']
    ));
}
?>