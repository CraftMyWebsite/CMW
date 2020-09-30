<?php
if($_Permission_->verifPerm('PermsPanel', 'payment', 'showPage')) {
	$lectureP = new Lire('modele/config/config.yml');
	$lectureP = $lectureP->GetTableau();
	$lectureP = $lectureP['Payement'];

	$query = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');

	$paypalOffres = $query->fetchAll(PDO::FETCH_ASSOC);

	$query = $bddConnection->query('SELECT * FROM cmw_paypal_historique WHERE 1 ORDER BY date DESC LIMIT 10');
	
	$paypalHistorique = $query->fetchAll(PDO::FETCH_ASSOC);

	$req = $bddConnection->query("SELECT * FROM cmw_paysafecard_offres");

	$paysafecard = $req->fetchAll(PDO::FETCH_ASSOC);

	$req = $bddConnection->query("SELECT cmw_paysafecard_historique.id AS id, pseudo, code, cmw_paysafecard_historique.statut AS statut, cmw_paysafecard_offres.montant AS montant, cmw_paysafecard_offres.jetons AS jetons  FROM cmw_paysafecard_historique INNER JOIN cmw_paysafecard_offres ON offre = cmw_paysafecard_offres.id");

	$tabPaysafe = $req->fetchAll(PDO::FETCH_ASSOC);

}

public function conversionDate($last_answer)
	{
		$last_answer = substr_replace($last_answer,"h",strpos($last_answer,":"),strlen(":"));
        $last_answer = str_replace(" ", " à ", substr($last_answer, 0, strpos($last_answer,":")));
		return $last_answer;
	}
?>