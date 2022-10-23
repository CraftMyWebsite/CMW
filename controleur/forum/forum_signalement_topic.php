<?php
if(isset($_POST['id_topic']) AND isset($_Joueur_['pseudo']))
{
	if(!isset($_GET['confirmation']))
	{
		header('Location: index.php?page=confirmation&id_topic='.$_POST['id_topic'].'&choix=5');
	}
	else
	{
		$reason = htmlspecialchars($_POST['reason']);
		$report = $bddConnection->prepare('INSERT INTO cmw_forum_report(type, id_topic_answer, reason, reporteur) VALUES(0, :id_topic_answer, :reason, :reporteur) ');
		$report->execute(array(
			'id_topic_answer' => $_POST['id_topic'],
			'reason' => $reason,
			'reporteur' => $_Joueur_['pseudo']
		));
		header('Location: index.php?page=forum&postSignalement');
		
	}
}
else
	header('Location: index.php?page=erreur&erreur=0');

?>