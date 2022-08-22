[DIV]
<?php
if(Permission::getInstance()->verifPerm("connect"))
{
	$req_vote_temp = $bddConnection->prepare('SELECT * FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_vote_temp->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	));
	$donneesVotesTemp = $req_vote_temp->fetchAll(PDO::FETCH_ASSOC);
	if(!empty($donneesVotesTemp)) {
		$tojs = array();
		$i = 0;
		foreach ($donneesVotesTemp as $data) {
			$tojs[$i] = $data['action'];
			$i++;
		}
		 echo json_encode(array_values($tojs)); 
	} else {
		echo json_encode(array_values(array()));
	}
}?>
