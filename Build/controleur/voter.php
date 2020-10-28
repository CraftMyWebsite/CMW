<?php
echo '[DIV]';
if(isset($_POST['id']) AND isset($_POST['pseudo']))
{

	$id = $_POST['id'];
	$pseudo = $_POST['pseudo'];
	require_once('modele/joueur/maj.class.php');
	$joueurMaj = new Maj($pseudo, $bddConnection);
	$playerData = $joueurMaj->getReponseConnection();
	$playerData = $playerData->fetch(PDO::FETCH_ASSOC);	

	require_once('modele/vote.class.php');

	$vote = new vote($bddConnection, $pseudo, $id);

	if($vote->exist()) {
		if($vote->canVote()) {
			if($vote->hasVote()) {
				$vote->confirmVote($bddConnection);
				if(isset($_Joueur_) && $_Joueur_['pseudo'] == $pseudo)
				{	
					$vote->stockVote($bddConnection, null, null);
					if(!empty($voteurs['pseudo']) && is_array($voteurs['pseudo'])) {
						$key = array_search($pseudo, $voteurs['pseudo']);
						if(isset($key)) {
							$verif = $RecompenseAuto->verifRecVotes($voteurs['nbre_votes'][$key]+1);

							if(!empty($verif))
							{
								foreach($verif as $action)
								{
									$vote->stockVote($bddConnection, $action, null);
								}
							}
						}
					}
				} else {
					$vote->giveRecompense($bddConnection, null, $jsonCon);
				}
				echo 'success';
			} else {
				echo 'erreur-1';
			}
		} else {
			echo 'erreur-2';
		}
	} else {
		echo 'erreur-3';
	}
} else {
	echo 'erreur-4';
}

?>
