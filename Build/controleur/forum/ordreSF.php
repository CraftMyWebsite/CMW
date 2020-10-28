<?php
if(Permission::getInstance()->verifPerm('PermsForum', 'general', 'deleteForum') and isset($_GET['modif']))
{
	$ordre = htmlspecialchars($_GET['ordre']);
	$id = htmlspecialchars($_GET['id']);
	if($_GET['modif'] == 'monter')
	{
		$preReq = $bddConnection->prepare('UPDATE cmw_forum_sous_forum SET ordre = :apres WHERE ordre = :avant');
		$preReq->execute(array(
			'avant' => $ordre-1,
			'apres' => $ordre));
		$req = $bddConnection->prepare('UPDATE cmw_forum_sous_forum SET ordre = :ordre WHERE id = :id');
		$req->execute(array(
			'ordre' => $ordre-1,
			'id' => $id
		));
	}
	else
	{
		$preReq = $bddConnection->prepare('UPDATE cmw_forum_sous_forum SET ordre = :apres WHERE ordre = :avant;
			UPDATE cmw_forum_sous_forum SET ordre = :ordre WHERE id = :id');
		$preReq->execute(array(
			'avant' => $ordre+1,
			'apres' => $ordre,
			'ordre' => $ordre+1,
			'id' => $id
		));
	}
	header('Location: ?page=forum_categorie&id='.$_GET['id_cat']);
}