<?php
include('modele/topVotes.class.php');
$topVotes = new TopVotes($bddConnection);
$topVotes = $topVotes->GetTopVoteurs();

$j = 1;
for($i = 1; $donneesVotes = $topVotes->fetch(PDO::FETCH_ASSOC); $i++)
{
	$voteur[$i]['pseudo'] = $donneesVotes['pseudo'];
	$voteur[$i]['nbre_votes'] = $donneesVotes['nbre_votes'];

	if(!isset($voteurs))
		$recherche = false;
	else
		$recherche = array_search($voteur[$i]['pseudo'], $voteurs['pseudo']);


	if($recherche == false)
	{
		$voteurs['pseudo'][$j] = $voteur[$i]['pseudo'];
		$voteurs['nbre_votes'][$j] = $voteur[$i]['nbre_votes'];		
		$j++;	
	}
	else
	{
		$voteurs['nbre_votes'][$recherche] = $voteurs['nbre_votes'][$recherche] + $donneesVotes['nbre_votes'];;
	}
}
if(isset($voteurs))
{
	foreach($voteurs['nbre_votes'] as $cle => $element)
	{
		$topVoteurs[$cle]['nbre_votes'] = $element;
	}
	foreach($voteurs['pseudo'] as $cle => $element)
	{
		$topVoteurs[$cle]['pseudo'] = $element;
	}

	foreach ($topVoteurs as $key => $row) {
	    $pseudo[$key]  = $row['pseudo'];
	    $nbre_votes[$key] = $row['nbre_votes'];
	}

	array_multisort($nbre_votes, SORT_DESC, $pseudo, SORT_ASC, $topVoteurs);
}
$req_vote = $bddConnection->prepare('SELECT id, lien, titre FROM cmw_votes_config WHERE serveur = :serveur');
$count_req = $bddConnection->prepare('SELECT COUNT(id) as count FROM cmw_votes_config WHERE serveur = :serveur');

if(isset($_Joueur_))
{
	$req_vote_temp = $bddConnection->prepare('SELECT * FROM cmw_votes_temp WHERE pseudo = :pseudo');
	$req_vote_temp->execute(array(
		'pseudo' => $_Joueur_['pseudo']
	));
	$donneesVotesTemp = $req_vote_temp->fetchAll(PDO::FETCH_ASSOC);
}
?>
