<?php 

if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings'))
{
	$type = intval(htmlspecialchars($_POST['type']));
	if($type == 1)
	{
		$value = htmlspecialchars($_POST['nbreVote']);
	}
	else
	{
		$value = intval(htmlspecialchars($_POST['rang']));
	}
	
	$action = $_POST['action'];
	
	$req = $bddConnection->prepare('INSERT INTO cmw_votes_recompense_auto_config (type, valueType, action) VALUES (:type, :value, :action)');
	$req->execute(array(
		'type' => $type,
		'value' => $value,
		'action' => $action
	));
}