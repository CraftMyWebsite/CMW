<?php
require('modele/recompenseAuto.class.php');
include('controleur/topVoteurs.php');


$RecompenseAuto = new RecompenseAuto($bddConnection);
$topRecompense = $RecompenseAuto->getTopRecompenses();
$dateRec = $RecompenseAuto->getDate();
if(isset($dateRec) && !empty($dateRec) && $dateRec['valueType'] != 0 && $dateRec['etat'] != 0)
{
	if($dateRec['etat'] <= time()) {

		require_once('modele/vote.class.php');
		foreach($topRecompense as $key => $value)
		{
			if(isset($topVoteurs[$key]['pseudo'])) {
				$vote = new vote($bddConnection, $topVoteurs[$key]['pseudo'], null);
				$vote->stockVote($bddConnection, $value, null);
			}
		}
		$RecompenseAuto->saveNextDate($dateRec, $bddConnection);
		$bddConnection->exec('DELETE FROM cmw_votes WHERE isOld=1');
		$bddConnection->exec('UPDATE cmw_votes SET `isOld`=1');
	}
}