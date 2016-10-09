<?php
if(isset($_POST['id_answer']) && isset($_Joueur_))
{
	$id = htmlspecialchars($_POST['id_answer']);
	$rtest = $bddConnection->prepare('SELECT Appreciation FROM cmw_forum_like WHERE id_answer = :id_answer AND pseudo = :pseudo');
	$rtest->execute(array(
		'id_answer' => $id,
		'pseudo' => $_Joueur_['pseudo']
	));
	$testcount = $rtest->rowCount();
	if($testcount > 1)
	{
		//erreur
	}
	else
	{
		$dtest = $rtest->fetch();
		$delete = $bddConnection->prepare('DELETE FROM cmw_forum_like WHERE id_answer = :id_answer AND pseudo = :pseudo AND Appreciation = :Appreciation');
		$delete->execute(array(
			'id_answer' => $id,
			'pseudo' => $_Joueur_['pseudo'],
			'Appreciation' => $dtest['Appreciation']
		));
	}
	$rheader = $bddConnection->prepare('SELECT id_topic FROM cmw_forum_answer WHERE id = :id');
	$rheader->execute(array(
		'id' => $id
	));
	$header = $rheader->fetch();
	header('Location: ' . $_Serveur_['General']['url'] . '?&page=post&id=' . $header['id_topic'] . '');
}

?>