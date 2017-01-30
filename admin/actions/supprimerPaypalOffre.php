<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['actions']['editOffrePaypal'] == true) {
	$req = $bddConnection->prepare('DELETE FROM cmw_jetons_paypal_offres WHERE id = :id');
	$req->execute(Array(    'id'    =>  $_GET['id']));
}
?>