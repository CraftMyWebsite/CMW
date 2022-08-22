<?php

if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'editRecompense')) 
{
	if(isset($_GET['id']))
	{
		$req = $bddConnection->prepare('DELETE FROM cmw_votes_recompense_auto_config WHERE id = :id');
		$req->execute(array(
			'id' => $_GET['id']
		));
	}
}