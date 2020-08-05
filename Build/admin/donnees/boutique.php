<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['showPage'] == true) {
	if(!isset($categories) AND !isset($offres) AND !isset($actions))
	{
		$categories = GetListeCategories($bddConnection);
		$offres = GetListeOffres($bddConnection);
		$actions = GetListeActions($bddConnection);

		$categorieNum = count($categories) + 1;
	}
}
	function getCouponsReduc($bdd)
	{
		$req = $bdd->query('SELECT * FROM cmw_boutique_reduction');
		$coupons = $req->fetchAll(PDO::FETCH_ASSOC);
		return $coupons;
	}

	function GetListeCategories($bdd)
	{
		$reponse = $bdd->query('SELECT * FROM cmw_boutique_categories');
		
		$categories = $reponse->fetchAll(PDO::FETCH_ASSOC);
		return $categories;
	}

	function GetListeOffres($bdd)
	{
		$reponse = $bdd->query('SELECT * FROM cmw_boutique_offres ORDER BY id');
		
		$offres = $reponse->fetchAll(PDO::FETCH_ASSOC);
		foreach($offres as $key => $value)
		{
			$offres[$key]['categorie'] = $offres[$key]['categorie_id'];
			unset($offres[$key]['categorie_id']);
		}
		return $offres;
	}

	function GetListeActions($bdd)
	{
		$reponse = $bdd->query('SELECT * FROM cmw_boutique_action ORDER BY id');
		
		$i = 0;
		$action = null;
		while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
		{
			$action[$i]['id'] = $donnees['id'];
			$action[$i]['methode'] = $donnees['methode'];

			if($action[$i]['methode'] == 0)
				$action[$i]['methodeTxt'] = 'Commande(sans /)';
			elseif($action[$i]['methode'] == 1)
				$action[$i]['methodeTxt'] = 'Message Serveur';
			elseif($action[$i]['methode'] == 2)
				$action[$i]['methodeTxt'] = 'Changer de grade';
			elseif($action[$i]['methode'] == 3)
				$action[$i]['methodeTxt'] = 'Give un item';
			elseif($action[$i]['methode'] == 4)
				$action[$i]['methodeTxt'] = 'Envoyer de l\'argent iConomy';
			elseif($action[$i]['methode'] == 5)
				$action[$i]['methodeTxt'] = 'Give d\'xp';
			elseif($action[$i]['methode'] == 6)
				$action[$i]['methodeTxt'] = 'Grade Site';

			if($action[$i]['methode'] == 6)
			{
				if($donnees['commande_valeur'] == 0) {
					$action[$i]['commande_valeur'] = 'Joueur';
				} elseif($donnees['commande_valeur'] == 1) {
					$action[$i]['commande_valeur'] = "Créateur";
				} elseif(fopen('./modele/grades/'.$donnees['commande_valeur'].'.yml', 'r')) {
					$openGradeSite = new Lire('./modele/grades/'.$donnees['commande_valeur'].'.yml');
					$readGradeSite = $openGradeSite->GetTableau();
					$action[$i]['commande_valeur'] = $readGradeSite['Grade'];
					if(empty($readGradeSite['Grade']))
						$action[$i]['commande_valeur'] = 'Joueur';
				} else {
					$action[$i]['commande_valeur'] = 'Joueur';
				}
				$action[$i]['grade'] = $donnees['commande_valeur'];
			}
			else
				$action[$i]['commande_valeur'] = $donnees['commande_valeur'];
			$action[$i]['id_offre'] = $donnees['id_offre'];
			$i++;
		}
		return $action;
	}
?>