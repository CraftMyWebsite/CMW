<?php
echo '[DIV]';
if (isset($topVoteurs)) { 
	$tojs = array();
	$img = new ImgProfil($bddConnection);
    if(isset($topVoteurs) && !empty($topVoteurs)) 
    { 
    	for ($i = 0; $i < count($topVoteurs); $i++) 
    	{  
    		if($i < intval($_Serveur_['vote']['maxDisplay'])) 
    		{
		        $tojs[$i]['pseudo'] = $topVoteurs[$i]['pseudo'];
		        $tojs[$i]['nombre'] = $topVoteurs[$i]['nbre_votes'];
		        $tojs[$i]['url'] = $img->getUrlHeadByPseudo($tojs[$i]['pseudo'], 25);
   			}	
   			else
   			{ 
   				break; 
   			} 
   		} 
   	}
    echo json_encode(array_values($tojs)); 
} else {
  echo json_encode(array_values(array()));
} ?>