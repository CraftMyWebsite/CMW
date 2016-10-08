<?php
for($i = 0; $i < count($lecture['Json']); $i++)
{
	if(!$conEtablie[$i])
		break;

	$bannis[$i] = $jsonCon[$i]->GetBanList();
	$banlist[$i] = $bannis[$i][0][0]['success'];
	$fileBan[$i] = $bannis[$i][1][0]['success'];
	$fileBan[$i] = explode("\n", $fileBan[$i]);

	for($j = 3; $j < count($fileBan[$i]); $j++)
	{
		$fileBan[$i][$j] = explode('|', $fileBan[$i][$j]);
	}	
	foreach($banlist[$i] as $cle => $element)
	{
		for($j = 3; $j < count($fileBan[$i]); $j++)
		{
			if($element == $fileBan[$i][$j][0])
				$banlist[$i][$cle] = array(
					'pseudo' => $fileBan[$i][$j][0],
					'date' => $fileBan[$i][$j][1],
					'source' => $fileBan[$i][$j][2],
					'temps' => $fileBan[$i][$j][3],
					'raison' => $fileBan[$i][$j][4]
					);
		}	
	}
}
?>