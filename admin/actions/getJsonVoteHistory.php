<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'voteHistory', 'showPage')) { 

	if($_POST['axe'] == 'nombre') {
		$_POST['axe'] = "nbre_votes";
	}
	$VoteHistoryReq = $bddConnection->query('SELECT id as id, id AS \'id2\', ip, nbre_votes, site, date_dernier, pseudo FROM cmw_votes WHERE pseudo LIKE \'%'.$_POST['search'].'%\' AND isOld=0 ORDER BY \''.$_POST['axe'].'\' \''.$_POST['axeType'].'\'');


	 $req = $bdd->query('SELECT id, lien FROM cmw_votes_config');

     while($TemplienData=$req->fetch(PDO::FETCH_ASSOC))
	{
		$lienData[$TemplienData['id']] = $TemplienData;
	}


	$i = 0;
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


						
						if(isset($lienData[$VoteHistoryData['site']]['lien'])) {
							$allHistory[$key]['all'][$VoteHistoryData['site']]['site'] = $lienData[$VoteHistoryData['site']]['lien'];
						} else {
							$allHistory[$key]['all'][$VoteHistoryData['site']]['site'] = "inconnue";
						}

						$allHistory[$key]['all'][$VoteHistoryData['site']]['nbre_votes'] = $VoteHistoryData['nbre_votes'];
						$allHistory[$key]['all'][$VoteHistoryData['site']]['date_dernier'] = date("F j, Y, G:i",$VoteHistoryData['date_dernier']); // a mettre en francais

						$allHistory[$key]['nbre_votes'] += $VoteHistoryData['nbre_votes'];
						if($VoteHistoryData['date_dernier'] > $allHistory[$key]['date_dernier']) {

							$allHistory[$key]['date_dernier'] = $VoteHistoryData['date_dernier'];
							$allHistory[$key]['date_dernier2'] = date("F j, Y, G:i",$VoteHistoryData['date_dernier']);

							if(isset($lienData[$VoteHistoryData['site']]['lien'])) {
								$allHistory[$key]['site'] = $lienData[$VoteHistoryData['site']]['lien'];
							} else {
								$allHistory[$key]['site'] = "inconnue";
							}
							$allHistory[$key]['ip'] = $VoteHistoryData['ip'];
						}
						break;
					}
				} }
			} else {
				$flag = false;
				if(isset($allHistory)) {
				foreach($allHistory as $key => $value) {
					if($allHistory[$key]['pseudo'] == $VoteHistoryData['pseudo'] ) {


						if(isset($lienData[$VoteHistoryData['site']]['lien'])) {
							$allHistory[$key]['all'][$VoteHistoryData['site']]['site'] = $lienData[$VoteHistoryData['site']]['lien'];
						} else {
							$allHistory[$key]['all'][$VoteHistoryData['site']]['site'] = "inconnue";
						}
						$allHistory[$key]['all'][$VoteHistoryData['site']]['nbre_votes'] = $VoteHistoryData['nbre_votes'];
						$allHistory[$key]['all'][$VoteHistoryData['site']]['date_dernier'] = date("F j, Y, G:i",$VoteHistoryData['date_dernier']);

						$flag = true;
						$i--;
						$allHistory[$key]['nbre_votes'] += $VoteHistoryData['nbre_votes'];
						if($VoteHistoryData['date_dernier'] > $allHistory[$key]['date_dernier']) {
							$allHistory[$key]['date_dernier'] = $VoteHistoryData['date_dernier'];
							$allHistory[$key]['date_dernier2'] = date("F j, Y, G:i",$VoteHistoryData['date_dernier']); // a mettre en francais

							if(isset($lienData[$VoteHistoryData['site']]['lien'])) {
								$allHistory[$key]['site'] = $lienData[$VoteHistoryData['site']]['lien'];
							} else {
								$allHistory[$key]['site'] = "inconnue";
							}
							$allHistory[$key]['ip'] = $VoteHistoryData['ip'];
						}
						break;
					}
				} }
				if(!$flag) {
					$VoteHistoryData['id'] = $i;

					if(isset($lienData[$VoteHistoryData['site']]['lien'])) {
						$VoteHistoryData['all'][$VoteHistoryData['site']]['site'] = $lienData[$VoteHistoryData['site']]['lien'];
					} else {
						$VoteHistoryData['all'][$VoteHistoryData['site']]['site'] = "inconnue";
					}
					$VoteHistoryData['all'][$VoteHistoryData['site']]['nbre_votes'] = $VoteHistoryData['nbre_votes'];
					$VoteHistoryData['all'][$VoteHistoryData['site']]['date_dernier'] = date("F j, Y, G:i",$VoteHistoryData['date_dernier']); // a mettre en francais
					
					if(isset($lienData[$VoteHistoryData['site']]['lien'])) {
						$VoteHistoryData['site'] = $lienData[$VoteHistoryData['site']]['lien'];
					} else {
						$VoteHistoryData['site'] = "inconnue";
					}

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