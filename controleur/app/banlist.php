<?php
foreach($jsonCon as $key => $serveur)
{
	if(!$conEtablie[$key])
		break;

	$bannis = $serveur->GetBanList();
	if(isset($bannis[0]['success']))
		$banlist[$key] = json_decode($bannis[0]['success']);
	else
		$banlist[$key] = array();
}
?>