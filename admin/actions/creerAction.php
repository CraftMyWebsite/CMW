<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { 
	if($_POST['methode'] == 6)
		$valeur = $_POST['grade_site'];
	else
		$valeur = $_POST['valeur'];
	$req = $bddConnection->prepare('INSERT INTO cmw_boutique_action(methode, commande_valeur, duree, id_offre) VALUES(:methode, :commande_valeur, :duree, :id_offre)');
	$req->execute(Array (
		'methode' => $_POST['methode'],
		'commande_valeur' => $valeur,
		'duree' => $_POST['duree'],
		'id_offre' => $_POST['id_offre'], ));
}
?>