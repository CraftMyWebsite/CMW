<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true) {
	if(isset($_GET['id']))
	{
		$id = htmlspecialchars($_GET['id']);
		$suppression = $bddConnection->prepare('DELETE FROM cmw_votes_config WHERE id = :id');
		$suppression->execute(array('id' => $id));
	}
}
?>