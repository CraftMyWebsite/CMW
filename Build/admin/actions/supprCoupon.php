<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['action']['modifCoupon'] == true)
{
	if(isset($_GET['id']))
	{
		$id = htmlspecialchars($_GET['id']);
		$req = $bddConnection->prepare('DELETE FROM cmw_boutique_reduction WHERE id = :id');
		$req->execute(array('id' => $id));
		header('Location: ?page=boutique');
	}
}