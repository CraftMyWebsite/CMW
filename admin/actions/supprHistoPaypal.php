<?php
if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'seePaypalHisto') && isset($_GET['id'])) {
    $req = $bddConnection->prepare('DELETE FROM `cmw_paypal_historique` WHERE id=:id');
    $req->execute(array('id' => $_GET['id']));
}