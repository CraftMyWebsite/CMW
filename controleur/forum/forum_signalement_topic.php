<?php
if(isset($_POST['id_topic']) AND isset($_Joueur_))
{
	if(!isset($_GET['confirmation']))
	{
		header('Location: confirmation/'.$_POST['id_topic'].'/5');
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
		header('Location: forum/postSignalement');
		
	}
}
else
	header('Location: erreur/0');

?>