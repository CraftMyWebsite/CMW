<?php 
$req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, id_topic, vu, cmw_forum_topic_followed.last_answer AS last_answer_int, cmw_forum_post.last_answer AS last_answer_pseudo, cmw_forum_topic_followed.new FROM cmw_forum_topic_followed
INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
$req_topic->execute(array(
	'pseudo' => $_Joueur_['pseudo']
));
$new = 0;
while($td = $req_topic->fetch())
{
	if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0 AND $td['new'] == 0)
	{
		$new++;
		$insert = $bddConnection->prepare('UPDATE cmw_forum_topic_followed SET new = 1 WHERE id_topic = :id AND pseudo = :pseudo');
		$insert->execute(array(
			'id' => $td['id_topic'],
			'pseudo' => $_Joueur_['pseudo']
		));
	}
}
$req_answer = $bddConnection->prepare('SELECT cmw_forum_like.pseudo AS pseudo_likeur, Appreciation, id_answer, cmw_forum_answer.pseudo
AS pseudo_posteur, id_topic, vu, new FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudop');
$req_answer->execute(array(
	'pseudo' => $_Joueur_['pseudo'],
	'pseudop' => $_Joueur_['pseudo']
));
while($answer_liked = $req_answer->fetch())
{
	if($answer_liked['vu'] == 0 AND $answer_liked['new'] == 0)
	{
		$new++;
		$update = $bddConnection->prepare('UPDATE cmw_forum_like SET new = 1 WHERE id_answer = :id AND pseudo = :pseudo ');
		$update->execute(array(
			'id' => $answer_liked['id_answer'],
			'pseudo' => $answer_liked['pseudo_likeur']
		));
	}
}
if($new != 0)
{
	echo $new;
}
?>