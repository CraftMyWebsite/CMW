

<?php
$j = 1;
for($i = 0; $i < count($offres); $i++)
{
	if($offres[$i]['categorie'] == $_POST['categorie'])
		$j++;
}


$req = $bddConnection->prepare('INSERT INTO cmw_boutique_offres(nom, description, prix, categorie_id, ordre) VALUES(:nom, :description, :prix, :categorie, :ordre)');
$req->execute(Array(
	'nom' => $_POST['nom'],
	'description' => $_POST['description'],
	'prix' => $_POST['prix'],
	'categorie' => $_POST['categorie'],
	'ordre' => $j ));
	
?>