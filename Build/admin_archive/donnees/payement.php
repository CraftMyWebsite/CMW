<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'showPage')) {
	$lectureP = new Lire('modele/config/config.yml');
	$lectureP = $lectureP->GetTableau();
	$lectureP = $lectureP['Payement'];

	$query = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');

	$i = 0;
	$paypalOffres = $query->fetchAll(PDO::FETCH_ASSOC);

	$req = $bddConnection->query("SELECT * FROM cmw_paysafecard_offres");

	$paysafecard = $req->fetchAll(PDO::FETCH_ASSOC);

	$req = $bddConnection->query("SELECT cmw_paysafecard_historique.id AS id, pseudo, code, cmw_paysafecard_historique.statut AS statut, cmw_paysafecard_offres.montant AS montant, cmw_paysafecard_offres.jetons AS jetons  FROM cmw_paysafecard_historique INNER JOIN cmw_paysafecard_offres ON offre = cmw_paysafecard_offres.id");

	$tabPaysafe = $req->fetchAll(PDO::FETCH_ASSOC);

}
?>