<?php
if(isset($_POST['id_topic2']) AND isset($_Joueur_))
{
	if(!isset($_GET['confirmation']))
	{
		header('Location: ' . $_Serveur_['General']['url'] . '?&page=confirmation&choix=5&id_topic=' . $_POST['id_topic2'] . '');
	}
	else
	{
		$reason = htmlspecialchars($_POST['reason']);
		$report = $bddConnection->prepare('INSERT INTO cmw_forum_report(type, id_topic_answer, reason, reporteur) VALUES(0, :id_topic_answer, :reason, :reporteur) ');
		$report->execute(array(
			'id_topic_answer' => $_POST['id_topic2'],
			'reason' => $reason,
			'reporteur' => $_Joueur_['pseudo']
		));
		header('Location: ?&page=forum');
		
	}
}

?>