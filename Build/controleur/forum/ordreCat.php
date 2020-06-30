<?php
if(isset($_Joueur_) AND ($_Joueur_['rang'] == 1 OR $_PGrades_['PermsForum']['general']['deleteForum'] == true) and isset($_GET['modif']))
{
	$ordre = htmlspecialchars($_GET['ordre']);
	$id = htmlspecialchars($_GET['id']);
	$forum = htmlspecialchars($_GET['forum']);
	if($_GET['modif'] == 'monter')
	{
		$preReq = $bddConnection->prepare('UPDATE cmw_forum_categorie SET ordre = :apres WHERE ordre = :avant AND forum = :forum');
		$preReq->execute(array(
			'avant' => $ordre-1,
			'apres' => $ordre,
			'forum' => $forum));
		$req = $bddConnection->prepare('UPDATE cmw_forum_categorie SET ordre = :ordre WHERE id = :id');
		$req->execute(array(
			'ordre' => $ordre-1,
			'id' => $id
		));
	}
	else
	{
		$preReq = $bddConnection->prepare('UPDATE cmw_forum_categorie SET ordre = :apres WHERE ordre = :avant AND forum = :forum;
			UPDATE cmw_forum_categorie SET ordre = :ordre WHERE id = :id');
		$preReq->execute(array(
			'avant' => $ordre+1,
			'apres' => $ordre,
			'ordre' => $ordre+1,
			'forum' => $forum,
			'id' => $id
		));
	}
	header('Location: ?page=forum');
}