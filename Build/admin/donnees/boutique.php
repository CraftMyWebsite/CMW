<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'showPage')) {
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
		$i = 0;
		while($fetch = $req->fetch(PDO::FETCH_ASSOC))
		{
			$coupons[$i] = $fetch;
			$i++;
		}
		return $coupons;
	}

	function GetListeCategories($bdd)
	{
		$reponse = $bdd->query('SELECT * FROM cmw_boutique_categories');
		
		$i = 0;
		$categories = null;
		while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
		{
			$categories[$i]['titre'] = $donnees['titre'];
			$categories[$i]['message'] = $donnees['message'];
			$categories[$i]['id'] = $donnees['id'];
			$categories[$i]['ordre'] = $donnees['ordre'];
			$i++;
		}
		return $categories;
	}

	function GetListeOffres($bdd)
	{
		$reponse = $bdd->query('SELECT * FROM cmw_boutique_offres ORDER BY id');
		
		$i = 0;
		$offres = null;
		while($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
		{
			$offres[$i]['id'] = $donnees['id'];
			$offres[$i]['ordre'] = $donnees['ordre'];
			$offres[$i]['nom'] = $donnees['nom'];
			$offres[$i]['description'] = $donnees['description'];
			$offres[$i]['prix'] = $donnees['prix'];
			$offres[$i]['nbre_vente'] = $donnees['nbre_vente'];
			$offres[$i]['categorie'] = $donnees['categorie_id'];
			$i++;
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