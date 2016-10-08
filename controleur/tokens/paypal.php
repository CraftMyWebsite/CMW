<?php

	$recupOffres = $bddConnection->query('SELECT * FROM cmw_jetons_paypal_offres');
		
	$offres = false;
		
	$i = 0;
	if($recupOffres)
	{
		while($tableauOffres = $recupOffres->fetch())
		{
			$offresTableau[$i] = array(
				'id' => $tableauOffres['id'],
				'nom' => $tableauOffres['nom'],
				'description' => $tableauOffres['description'],
				'jetons_donnes' => $tableauOffres['jetons_donnes'],
				'prix' => $tableauOffres['prix'] );

			if($_Serveur_['Payement']['paypalMethodeAPI'] == 1)
				$lienPaypal[$i] = 'viaMail';
			else
				$lienPaypal[$i] = '?&action=achatPaypal&offer=' .$offresTableau[$i]['id'];
			$i++;
		}
		$offres = true;
	}

?>