<?php 
$req_topic = $bddConnection->prepare('SELECT cmw_forum_topic_followed.pseudo, id_topic, vu, cmw_forum_topic_followed.last_answer AS last_answer_int, cmw_forum_post.last_answer AS last_answer_pseudo FROM cmw_forum_topic_followed
INNER JOIN cmw_forum_post WHERE id_topic = cmw_forum_post.id AND cmw_forum_topic_followed.pseudo = :pseudo');
$req_topic->execute(array(
	'pseudo' => $_Joueur_['pseudo']
));
$alerte = 0;
while($td = $req_topic->fetch())
{
	if($td['pseudo'] != $td['last_answer_pseudo'] AND $td['last_answer_pseudo'] != NULL AND $td['vu'] == 0)
	{
		$alerte++;
	}
}
$req_answer = $bddConnection->prepare('SELECT cmw_forum_like.pseudo AS pseudo_likeur, Appreciation, id_answer, cmw_forum_answer.pseudo
AS pseudo_posteur, id_topic, vu	FROM cmw_forum_like INNER JOIN cmw_forum_answer WHERE id_answer = cmw_forum_answer.id
AND cmw_forum_like.pseudo != :pseudo AND cmw_forum_answer.pseudo = :pseudop');
$req_answer->execute(array(
	'pseudo' => $_Joueur_['pseudo'],
	'pseudop' => $_Joueur_['pseudo']
));
while($answer_liked = $req_answer->fetch())
{
	if($answer_liked['vu'] == 0)
	{
		$alerte++;
	}
}
echo $alerte;
?>