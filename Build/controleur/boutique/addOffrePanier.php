<?php 
if(isset($_Joueur_) && isset($_GET['offre']) && isset($_GET['quantite']))
{
	if($_GET['quantite'] > 0)
	{
		$req = $bddConnection->prepare('SELECT prix, nbre_vente FROM cmw_boutique_offres WHERE id = :offre');
		$req->execute(array(
			'offre' => htmlspecialchars($_GET['offre'])
		));
		$fetch = $req->fetch(PDO::FETCH_ASSOC);
		if($fetch['nbre_vente'] == 0 )
		{
			header('Location: ?page=erreur&erreur=19&type='.htmlspecialchars("Erreur Boutique").'&titre='.htmlspecialchars("Stock insufisant !"). '&contenue='.htmlspecialchars("Désolé, mais un des articles que vous souhaitez acheter est indisponible pour l'instant :( !"));
				exit();
		}
		$execution = $_Panier_->ajouterProduit(htmlspecialchars($_GET['offre']), htmlspecialchars($_GET['quantite']), $fetch['prix']);
		if($execution !== false)
			header('Location: ?page=boutique');
		else
			var_dump($execution); var_dump($_GET);
	}
	else
		header('Location: ?page=erreur&erreur=17');
}
else
	header('Location: ?page=erreur&erreur=17');
?>