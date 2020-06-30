<?php
if(isset($_POST['id_answer']) && isset($_Joueur_))
{
	$id = htmlspecialchars($_POST['id_answer']);
	if(isset($_POST['type']))
		$type = 1;
	else
		$type = 2;
	$rtest = $bddConnection->prepare('SELECT Appreciation FROM cmw_forum_like WHERE id_answer = :id_answer AND pseudo = :pseudo AND type = :type');
	$rtest->execute(array(
		'id_answer' => $id,
		'pseudo' => $_Joueur_['pseudo'],
		'type' => $type
	));
	$testcount = $rtest->rowCount();
	if($testcount > 1)
	{
		header('Location: ?page=erreur&erreur=17');
	}
	else
	{
		$dtest = $rtest->fetch(PDO::FETCH_ASSOC);
		$delete = $bddConnection->prepare('DELETE FROM cmw_forum_like WHERE id_answer = :id_answer AND pseudo = :pseudo AND Appreciation = :Appreciation AND type = :type');
		$delete->execute(array(
			'id_answer' => $id,
			'pseudo' => $_Joueur_['pseudo'],
			'Appreciation' => $dtest['Appreciation'],
			'type' => $type
		));
	}
	if($type == 2)
	{
		$rheader = $bddConnection->prepare('SELECT id_topic FROM cmw_forum_answer WHERE id = :id');
		$rheader->execute(array(
			'id' => $id
		));
		$header = $rheader->fetch(PDO::FETCH_ASSOC);
		header('Location: ?&page=post&id=' . $header['id_topic'] . '');
	}
	else
		header('Location: ?page=post&id='.$id);
}
else
	header('Location: ?page=erreur&erreur=0');
?>