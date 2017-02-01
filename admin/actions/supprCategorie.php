<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == true) {
	$query = $bddConnection->prepare('SELECT id FROM cmw_boutique_offres WHERE id = :id');
	$query->execute(array( 'id' => $_GET['id']));

	$req = $bddConnection->prepare('DELETE FROM cmw_boutique_categories WHERE id = :id');
	$req->execute(array( 'id' => $_GET['id']));
	$req = $bddConnection->prepare('DELETE FROM cmw_boutique_offres WHERE categorie_id = :id');
	$req->execute(array( 'id' => $_GET['id']));

	if(!empty($query));
	while($donnees = $query->fetch())
	{
		$req = $bddConnection->prepare('DELETE FROM cmw_boutique_action WHERE id_offre = :id');
		$req->execute(array('id' => $donnees['id'] ));
	}
}
?>