<?php
if($_POST['ajax'] == true)
{
	$active = htmlspecialchars($_POST['active']);
	require('modele/forum/forum.class.php');
	$_Forum_ = new Forum($bddConnection);
	$Chat = new Chat($jsonCon);
	$retour = array();
	for($i=0; $i < count($jsonCon); $i++)
	{
		$messages = $Chat->getMessages($i);
		if($messages != false && $messages != "erreur" && $messages != "query")
		{
			$messages = array_slice($messages, -10, 10);
			foreach($messages as $key => $value)
			{
				if($key < 10)
				{
					$retour['msg'][$key]['pseudo'] = $value['player'];
					$retour['msg'][$key]['date'] = date('H:i', $value['time']);
					$retour['msg'][$key]['message'] = $Chat->formattage(htmlspecialchars($value['message']));
				}
			}
			$retour['success'] = "true";
		}
		elseif($messages == "query")
			$retour['success'] = "query";
		elseif($messages == "erreur")
			$retour['success'] = "erreur";
		else
			$retour['success'] = 'false';
		echo(json_encode($retour));
	}
}
?>