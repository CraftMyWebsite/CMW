<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'payment', 'actions', 'editOffrePaysafeCard'))
{
	$req = $bddConnection->prepare('UPDATE cmw_paysafecard_offres SET jetons = :jetons, description = :description, statut = :statut WHERE id = :id');
	$req->execute(array(
		'jetons' => $_POST['jetons'],
		'description' => $_POST['description'],
		'statut' => ($_POST['statut'] == 'on') ? 1 : 0,
		'id' => $_GET['id']
	));
}
?>