<?php 
if(isset($_Joueur_) && $_Joueur_['rang'] == 1)
{
	if(isset($_GET['id']))
	{
		$req = $bddConnection->prepare('DELETE FROM cmw_ban WHERE id = :id');
		$req->execute(array(
			'id' => $_GET['id']
		));
	}
}