<?php
if(isset($_POST['id_answer']) AND isset($_Joueur_) )
{
	$id = htmlspecialchars($_POST['id_answer']);
	if(!isset($_GET['confirmation']))
	{
		header("Location: {$_Serveur_['General']['url']}?&page=confirmation&choix=4&id={$id}");
	}
	else
	{
		$reason = htmlspecialchars($_POST['reason']);
		$insert = $bddConnection->prepare('INSERT INTO cmw_forum_report(type, id_topic_answer, reason, reporteur) VALUES (1, :id_topic_answer, :reason, :reporteur)');
		$insert->execute(array(	
			'id_topic_answer' => $id,
			'reason' => $reason,
			'reporteur' => $_Joueur_['pseudo']
		));
		header('Location: ?&page=forum');
	}
}
?>