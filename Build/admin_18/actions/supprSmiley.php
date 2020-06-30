<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'seeSmileys']))
{
	if(isset($_GET['image'], $_GET['id']))
	{
		$id = htmlspecialchars($_GET['id']);
		$image = htmlspecialchars($_GET['image']);
		unlink($image);
		$suppReq = $bddConnection->prepare('DELETE FROM cmw_forum_smileys WHERE id = :id');
		$suppReq->execute(array('id' => $id));
	}
}