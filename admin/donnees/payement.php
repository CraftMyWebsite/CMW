<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['payment']['showPage'] == true) {
	$lectureP = new Lire('modele/config/config.yml');
	$lectureP = $lectureP->GetTableau();
	$lectureP = $lectureP['Payement'];

	$microTokens = new Lire('modele/config/configAlloconv.yml');
	$microTokens = $microTokens->GetTableau();

	$query = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');

	$i = 0;
	while($donneesQuery = $query->fetch())
	{
		$paypalOffres[$i]['id'] = $donneesQuery['id'];
		$paypalOffres[$i]['nom'] = $donneesQuery['nom'];
		$paypalOffres[$i]['description'] = $donneesQuery['description'];
		$paypalOffres[$i]['prix'] = $donneesQuery['prix'];
		$paypalOffres[$i]['jetons_donnes'] = $donneesQuery['jetons_donnes'];
		$i++;
	}
}
?>