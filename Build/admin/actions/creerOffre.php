<?php
if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'addOffre')) {
	require_once('./admin/donnees/boutique.php');
	$j = 1;
	if($offres != null){
		for($i = 0; $i < count($offres); $i++)
		{
			if($offres[$i]['categorie'] == $_POST['categorie'])
			{
				$j++;
			}
		}
	}


	$req = $bddConnection->prepare('INSERT INTO cmw_boutique_offres(nom, description, prix, nbre_vente, categorie_id, ordre, evo, max_vente) VALUES(:nom, :description, :prix, :nbre_vente, :categorie_id, :ordre, :evo, :max_vente)');
	$req->execute(Array(
		'nom' => $_POST['nom'],
		'description' => $_POST['description'],
		'prix' => $_POST['prix'],
		'nbre_vente' =>  $_POST['nbre_vente'],
		'categorie_id' => $_POST['categorie'],
		'ordre' => $j,
		'evo' => $_POST['dep'],
		'max_vente' => $_POST['max_vente']));
}
?>