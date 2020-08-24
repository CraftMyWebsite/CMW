<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) { 

	if($_POST['axe'] == 'nombre') {
		$_POST['axe'] = "nbre_votes";
	}
	$VoteHistoryReq = $bddConnection->query('SELECT id as id, id AS \'id2\', ip, nbre_votes, site, date_dernier, pseudo FROM cmw_votes WHERE pseudo LIKE \'%'.$_POST['search'].'%\' ORDER BY \''.$_POST['axe'].'\' \''.$_POST['axeType'].'\'');

	$i = 0;
	echo var_dump($VoteHistoryReq);
	while($VoteHistoryData = $VoteHistoryReq->fetch(PDO::FETCH_ASSOC))
	{
		$i++;
		if($i > ($_POST['index']) * $_POST['max'])
		{
			if($i > ($_POST['index']+1 ) * $_POST['max'])
			{
				if(isset($allHistory)) {
				foreach($allHistory as $key => $value) {
					if($allHistory[$key]['pseudo'] == $VoteHistoryData['pseudo'] ) {
						$allHistory[$key]['nbre_votes'] += $VoteHistoryData['nbre_votes'];
						if($VoteHistoryData['date_dernier'] > $allHistory[$key]['date_dernier']) {
							$allHistory[$key]['date_dernier'] = $VoteHistoryData['date_dernier'];
							$allHistory[$key]['site'] = $VoteHistoryData['site'];
							$allHistory[$key]['ip'] = $VoteHistoryData['ip'];
						}
						break;
					}
				} }
			} else {
				$flag = false;
				if(isset($allHistory)) {
				foreach($allHistory as $key => $allHistory[$key]) {
					if($allHistory[$key]['pseudo'] == $VoteHistoryData['pseudo'] ) {
						$flag = true;
						$i--;
						$allHistory[$key]['nbre_votes'] += $VoteHistoryData['nbre_votes'];
						if($VoteHistoryData['date_dernier'] > $allHistory[$key]['date_dernier']) {
							$allHistory[$key]['date_dernier'] = $VoteHistoryData['date_dernier'];
							$allHistory[$key]['site'] = $VoteHistoryData['site'];
							$allHistory[$key]['ip'] = $VoteHistoryData['ip'];
						}
						break;
					}
				} }
				if(!$flag) {
					$VoteHistoryData['id'] = $i;
					$allHistory[$i] =$VoteHistoryData;
				}
			}
		}
	}
	echo '[DIV]';
	if(isset($allHistory) && !empty($allHistory)) {
		echo json_encode(array_values($allHistory)); 
	}

} ?>