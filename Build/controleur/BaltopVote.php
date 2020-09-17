[DIV]
<?php
if (isset($topVoteurs)) { 
	$i = 0;
	$tojs = array();
	foreach ($donneesVotesTemp as $data) { 
		$tojs[$i]=$data['action'];
    	$i++;
    }
    echo json_encode(array_values($tojs)); 
} ?>
