<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'showPage')) {
	if(!isset($categories) AND !isset($offres) AND !isset($actions))
	{
		$categories = GetListeCategories($bddConnection);

		require_once('modele/boutique/offres.class.php'); 
		$offre = new OffresList($bddConnection, $jsonCon, $_Joueur_);
		$offres = $offre->GetTableauOffres();
		$offresByGet = $offre->GetOffresGet();
		$actions = GetListeActions($bddConnection);

		$categorieNum = count($categories) + 1;

		$recup = $bddConnection->query('SELECT * FROM cmw_grades ORDER BY priorite');
		$idGrade = $recup->fetchAll(PDO::FETCH_ASSOC);
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