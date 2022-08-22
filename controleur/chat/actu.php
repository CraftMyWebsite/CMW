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
					$retour[$i]['msg'][$key]['pseudo'] = $value['player'];
					$retour[$i]['msg'][$key]['date'] = date('H:i', $value['time']);
					$retour[$i]['msg'][$key]['message'] = $Chat->formattage(htmlspecialchars($value['message']));
				}
			}
			$retour[$i]['success'] = "true";
		}
		elseif($messages == "query")
			$retour[$i]['success'] = "query";
		elseif($messages == "erreur")
			$retour[$i]['success'] = "erreur";
		else
			$retour[$i]['success'] = 'false';
	}
	echo(json_encode($retour));
}
?>