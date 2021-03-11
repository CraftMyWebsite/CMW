<?php
include('modele/topVotes.class.php');
$topVotes = new TopVotes($bddConnection);
$topVotes = $topVotes->GetTopVoteurs();


for($i = 0; $donneesVotes = $topVotes->fetch(PDO::FETCH_ASSOC); $i++)
{
	$topVoteurs[$i] = $donneesVotes;
}

$req_vote = $bddConnection->prepare('SELECT id, lien, titre FROM cmw_votes_config WHERE serveur = :serveur');
$count_req = $bddConnection->prepare('SELECT COUNT(id) as count FROM cmw_votes_config WHERE serveur = :serveur');
if(isset($_Serveur_['vote']['oldDisplay'])) {
	$oldvote_req = $bddConnection->query('SELECT pseudo, nbre_votes FROM cmw_votes WHERE isOld=1 group by pseudo ORDER BY nbre_votes DESC');
}

?>
