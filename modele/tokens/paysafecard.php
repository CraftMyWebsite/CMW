<?php

	$recupOffres = $bddConnection->query('SELECT * FROM cmw_paysafecard_offres WHERE statut = 1');
		
	$paysafecardTab = $recupOffres->fetchAll(PDO::FETCH_ASSOC);
?>