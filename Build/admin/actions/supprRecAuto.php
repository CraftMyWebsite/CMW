<?php

if(isset($_Joueur_) && ($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true)))
{
	if(isset($_GET['id']))
	{
		$req = $bddConnection->prepare('DELETE FROM cmw_votes_recompense_auto_config WHERE id = :id');
		$req->execute(array(
			'id' => $_GET['id']
		));
	}
}