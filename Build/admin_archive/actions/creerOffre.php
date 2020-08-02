<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'shop', 'actions', 'addOffre')) {
	$j = 1;
	if($offres != null){
		for($i = 0; $i < count($offres); $i++)
		{
			if($offres[$i]['categorie'] == $_POST['categorie'])
				$j++;
		}
	}


	$req = $bddConnection->prepare('INSERT INTO cmw_boutique_offres(nom, description, prix, nbre_vente, categorie_id, ordre) VALUES(:nom, :description, :prix, :nbre_vente, :categorie_id, :ordre)');
	$req->execute(Array(
		'nom' => $_POST['nom'],
		'description' => $_POST['description'],
		'prix' => $_POST['prix'],
		'nbre_vente' => (isset($_POST['nbre_vente'])) ? $_POST['nbre_vente'] : -1,
		'categorie_id' => $_POST['categorie'],
		'ordre' => $j ));
}
?>