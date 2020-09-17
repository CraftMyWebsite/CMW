[DIV]
<?php
if (isset($topVoteurs)) { 
	$tojs = array();
    for ($i = 0; $i < count($topVoteurs) and $i < $_Serveur_['vote']['maxDisplay']; $i++) {  
        $tojs[$i]['pseudo'] = $topVoteurs[$i]['pseudo'];
        $tojs[$i]['nombre'] = $topVoteurs[$i]['nbre_votes'];
    }
    echo json_encode(array_values($tojs)); 
} ?>
