<?php
	if($_Joueur_['tokens'] >= $_Panier_->montantGlobal())
	{
		$nb = $_Panier_->compterArticle();
		for($a = 0; $a < $nb; $a++)
		{
			$req = $bddConnection->prepare("SELECT nbre_vente FROM cmw_boutique_offres WHERE id = :id");
			$req->execute(array("id" => $_SESSION['panier']['id'][$a]));
			$d = $req->fetch(PDO::FETCH_ASSOC);
			if($d["nbre_vente"] == "0"){
				header('Location: ?page=erreur&erreur=19&type='.htmlspecialchars("Erreur Boutique").'&titre='.htmlspecialchars("Stock insufisant !"). '&contenue='.htmlspecialchars("Désolé, mais un des articles que vous souhaitez acheter est indisponible pour l'instant :( !"));
				exit();
			}
			if($_SESSION['panier']['prix'][$a] >= 0 && $_SESSION['panier']['quantite'][$a] > 0)
			{
				$probleme[$a] = 0;
				if($d['nbre_vente'] > 0)
				{
					if($d['nbre_vente'] - $_SESSION['panier']['quantite'][$a] >= 0)
					{
						$req = $bddConnection->prepare("UPDATE cmw_boutique_offres SET nbre_vente = :nbre_vente WHERE id = :id");
						$req->execute(array("nbre_vente" => $d['nbre_vente']-$_SESSION['panier']['quantite'][$a], "id" => $_SESSION['panier']['id'][$a]));
					}
					else
					{
						$problème[$a] = 1;
					}
				}
				if($probleme[$a] != 1)
				{
					$recupActions = $bddConnection->prepare('SELECT * FROM cmw_boutique_action WHERE id_offre = :id_offre');
					$recupActions->execute(array('id_offre' => $_SESSION['panier']['id'][$a]));
					$offre = $_SESSION['panier']['id'][$a];
					require_once('modele/boutique/offres.class.php'); 
					$offres = new OffresList($bddConnection, $jsonCon);
					$offresTableau = $offres->GetTableauOffres();
					$offresByGet = $offres->GetOffresGet();

					require_once('modele/boutique/categories.class.php');
					$categoriesObj = new CategoriesList($bddConnection);
					$categories = $categoriesObj->GetTableauCategories();

					foreach($jsonCon as $key => $serveur)
					{
						$enligne[$key] = false;
						$serveurStats[$key] = $serveur->GetServeurInfos();
						if(isset($_Joueur_['pseudo']) AND isset($serveurStats[$key]['joueurs']) AND in_array($_Joueur_['pseudo'], $serveurStats[$key]['joueurs']))
							$enligne[$key] = true;
					}
					$infosOffre = $offres->GetInfosOffre($offre, $_Joueur_);
					$infosCategories = $categoriesObj->GetInfosCategorie($infosOffre['offre']['categorie'], $lectureJSON);
					foreach($jsonCon as $serveur)
					{
						$serveur->SetPlayerName($_Joueur_['pseudo']);
					}
					while($donneesActions = $recupActions->fetch(PDO::FETCH_ASSOC))
					{

						if($infosCategories['serveurId'] == -1) 
							foreach($jsonCon as $serveur)
							{
								for($z=0; $z < $_SESSION['panier']['quantite'][$a]; $z++)
								{
									SendCommand($serveur, $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree'], $bddConnection, $_Joueur_);
								}
							}
						elseif($infosCategories['serveurId'] == -2)
							foreach($jsonCon as $key => $serveur)
							{
								for($z = 0; $z < $_SESSION['panier']['quantite'][$a]; $z++)
								{
									if($enligne[$key])
										SendCommand($serveur, $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree'], $bddConnection, $_Joueur_['pseudo'], $_Joueur_);
								}
							}
						else
							for($z = 0; $z < $_SESSION['panier']['quantite'][$a]; $z++)
							{
								$cle = array_search($infosCategories['serveurId'], array_column($lectureJSON, 'id'));
								SendCommand($jsonCon[$cle], $donneesActions['methode'], $donneesActions['commande_valeur'], $donneesActions['duree'], $bddConnection, $_Joueur_);
							}
					}
					require_once('modele/app/statistiques.class.php');
				    $stats = new StatsUpdate($bddConnection);
				    $aretirer = false;
				    if(isset($_SESSION['panier']['reduction_categorie']))
				    {
					    $getCategorie = $bddConnection->prepare('SELECT categorie_id FROM cmw_boutique_offres WHERE id = :id');
					    $getCategorie->execute(array(
					    	'id' => $_SESSION['panier']['id'][$a]
					    ));
					    $fetch = $getCategorie->fetch(PDO::FETCH_ASSOC);
					    if($fetch['categorie_id'] == $_SESSION['panier']['reduction_categorie'])
					    {
					    	if(isset($_SESSION['panier']['reduction_expire']))
					    	{
					    		if($_Panier_->verifExpire($aretirer))
					    			$prix = $_SESSION['panier']['prix'][$a]*$_SESSION['panier']['quantite'][$a]*(1-$_SESSION['panier']['reduction']);
					    		else
					    			$prix = $_SESSION['panier']['prix'][$a]*$_SESSION['panier']['quantite'][$a];
					    	}
					    	else
					    		$prix = $_SESSION['panier']['prix'][$a]*$_SESSION['panier']['quantite'][$a]*(1-$_SESSION['panier']['reduction']);
					    }
					    else
					    	$prix = $_SESSION['panier']['prix'][$a]*$_SESSION['panier']['quantite'][$a];
					}
					else
						$prix = $_SESSION['panier']['prix'][$a]*$_SESSION['panier']['quantite'][$a]*(1-$_SESSION['panier']['reduction']);
					if($aretirer == true)
						$_Panier_->retirerReduction();
				    $stats->AddSell($_SESSION['panier']['id'][$a], $prix, $_Joueur_['pseudo']);
					$oldValues = $bddConnection->prepare('SELECT tokens FROM cmw_users WHERE pseudo = :pseudo');
					$oldValues->execute( array (
						'pseudo' => $_Joueur_['pseudo'] ));
					$oldTokens = $oldValues->fetch(PDO::FETCH_ASSOC);
					$update = $bddConnection->prepare('UPDATE cmw_users set tokens = :tokens WHERE pseudo = :pseudo');
					$update->execute( array (
						'tokens' => $oldTokens['tokens'] - $prix,
						'pseudo' => $_Joueur_['pseudo'] ));

					$_Joueur_['tokens'] = $_Joueur_['tokens'] - $prix;
					$_SESSION['Player']['tokens'] = $_Joueur_['tokens'];
				}
			}
		}
		$_Panier_->supprimerPanier();
		if(array_search('1', $probleme))
			header('Location: ?page=erreur&erreur=19&type='.htmlspecialchars("Erreur Boutique").'&titre='.htmlspecialchars("Stock insufisant !"). '&contenue='.htmlspecialchars("Désolé, mais un des articles que vous souhaitez acheter est indisponible pour l'instant :( ! Vos autres articles ont été livrés correctement."));
		else
			header('Location: ?page=panier&success=true');
	}
	else
		header('Location: ?page=erreur&erreur=18');

function SendCommand($jsonCon, $methode, $valeur, $duree, $bdd, &$joueur)
{
	if($methode == 0)
		$jsonCon->runConsoleCommand($valeur);
	
	if($methode == 1)
		$jsonCon->SendBroadcast($valeur);
		
	if($methode == 2)
		$jsonCon->AddPlayerToGroup($valeur, $duree);
	
	if($methode == 3)
		$jsonCon->GivePlayerItem($valeur);
		
	if($methode == 4)
		$jsonCon->GivePlayerMoney($valeur);
		
	if($methode == 5)
		$jsonCon->GivePlayerXp($valeur);
	if($methode == 6)
	{
		$req = $bdd->prepare('UPDATE cmw_users SET rang = :rang WHERE id = :id');
		$req->execute(array('rang' => $valeur,
							'id' => $joueur['id']));
		$joueur['rang'] = $valeur;
		$_SESSION['Player']['rang'] = $valeur;

	}
}
?>
