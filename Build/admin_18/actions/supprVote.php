<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) {
	if(isset($_GET['id']))
	{
		$id = htmlspecialchars($_GET['id']);
		$suppression = $bddConnection->prepare('DELETE FROM cmw_votes_config WHERE id = :id');
		$suppression->execute(array('id' => $id));
	}
}
?>