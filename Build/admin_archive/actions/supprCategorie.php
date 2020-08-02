<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre'])) {
	$query = $bddConnection->prepare('SELECT id FROM cmw_boutique_offres WHERE id = :id');
	$query->execute(array( ':id' => $_GET['id']));

	$req1 = $bddConnection->prepare('DELETE FROM cmw_boutique_categories WHERE id = :id');
	$req1->execute(array( ':id' => $_GET['id']));
	
	$req2 = $bddConnection->prepare('DELETE FROM cmw_boutique_offres WHERE categorie_id = :id');
	$req2->execute(array( ':id' => $_GET['id']));

	$req3 = $bddConnection->prepare('DELETE FROM cmw_boutique_stats WHERE offre_id = :id');
	$req3->execute(array( ':id' => $_GET['id']));

	if(!empty($query));
	while($donnees = $query->fetch(PDO::FETCH_ASSOC))
	{
		$req4 = $bddConnection->prepare('DELETE FROM cmw_boutique_action WHERE id_offre = :id');
		$req4->execute(array(':id' => $donnees['id']));
	}
}
?>