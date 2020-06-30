<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['forum']['actions']['seePrefix'] == true)
{
	$id = htmlspecialchars($_GET['id']);
	$req = $bddConnection->prepare('DELETE FROM cmw_forum_prefix WHERE id = :id');
	$req->execute(array('id' => $id));
	$reqUpdate = $bddConnection->prepare('UPDATE cmw_forum_post SET prefix = 0 WHERE prefix = :prefix');
	$reqUpdate->execute(array('prefix' => $id));
}