<?php
for($i = 0; $i < count($lecture['Json']); $i++)
{
	if(!$conEtablie[$i])
		break;

	$bannis = $jsonCon[$i]->GetBanList();
	if(isset($bannis[0]['success']))
		$banlist[$i] = json_decode($bannis[0]['success']);
	else
		$banlist[$i] = array();
}
?>