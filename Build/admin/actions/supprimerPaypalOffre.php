<?php
if($_Permission_->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaypal')) {
	$req = $bddConnection->prepare('DELETE FROM cmw_jetons_paypal_offres WHERE id = :id');
	$req->execute(Array(    'id'    =>  $_GET['id']));
}
?>