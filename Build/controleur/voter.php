<?php

if(isset($_POST['id']) AND isset($_POST['pseudo']))
{
	$id = $_POST['id'];
	$pseudo = $_POST['pseudo'];
	require_once('modele/joueur/maj.class.php');
	$joueurMaj = new Maj($pseudo, $bddConnection);
	$playerData = $joueurMaj->getReponseConnection();
	$playerData = $playerData->fetch(PDO::FETCH_ASSOC);	


	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$jsonCon[$i]->SetConnectionBase($bddConnection);
	}


	$donnees = RecupJoueur($pseudo, $id, $bddConnection);
	$lectureVotes = LectureVote($id, $bddConnection);

	$succes = false;
			if(!Vote($pseudo, $id, $bddConnection, $donnees, $lectureVotes['temps']))
			{
				echo 'erreur-3';
			}
			else if(verifVote($lectureVotes['lien'], $lectureVotes['idCustom']))
			{
				$req = $bddConnection->prepare('UPDATE cmw_votes SET nbre_votes = nbre_votes + 1, date_dernier = :tmp WHERE pseudo = :pseudo AND site = :site');
					$req->execute(array(
						'tmp' => time(),
						'pseudo' => $pseudo,
						'site' => $id));
				if(isset($_Joueur_) && $_Joueur_['pseudo'] == $pseudo)
				{
					//Système de vérification des récompenses auto
					$key = array_search($pseudo, $voteurs['pseudo']);
					$verif = $RecompenseAuto->verifRecVotes($voteurs['nbre_votes'][$key]+1);
					if(!empty($verif))
					{
						foreach($verif as $value)
						{
							$action = explode(':', $value['commande'], 2);
							if($action[0] == "give")
							{
								$action = explode(':', $action[1]);
								$idI = $action[1];
								$quantite = $action[3];
							}
							elseif($action[0] == "jeton")
							{
								$quantite = $action[1];
							}
							$message = str_replace('{JOUEUR}', $pseudo, str_replace('{QUANTITE}', $quantite, str_replace('{ID}', $idI, str_replace('&amp;', '§', $value['message']))));
							if(!empty($value['message']))
							{
								$jsonCon[$value['serveur']]->SendBroadcast($message);
							}
							$req = $bddConnection->prepare('INSERT INTO cmw_votes_temp (pseudo, methode, action, serveur) VALUES (:pseudo, :methode, :action, :serveur)');
							$req->execute(array(
								'pseudo' => $pseudo,
								'methode' => 2,
								'action' => $value['commande'],
								'serveur' => $value['serveur']
							));
						}
					}
					//Système de l'envoie du message
					if(!empty($lectureVotes['message']))
					{
						$action = explode(':', $lectureVotes['action'], 2);
						if($action[0] == "give")
						{
							$action = explode(':', $action[1]);
							$idI = $action[1];
							$quantite = $action[3];
						}
						elseif($action[0] == "jeton")
						{
							$quantite = $action[1];
						}
						$message = str_replace('{JOUEUR}', $pseudo, str_replace('{QUANTITE}', $quantite, str_replace('{ID}', $idI, str_replace('&amp;', '§', $lectureVotes['message']))));
						if($lectureVotes['methode'] == 2)
							$jsonCon[$value['serveur']]->SendBroadcast($message);
						else
							for($j =0; $j < count($jsonCon); $j++)
								$jsonCon[$j]->SendBroadcast($message);
					}
					//Système de récupérer plus tard
					$req = $bddConnection->prepare('INSERT INTO cmw_votes_temp (pseudo, methode, action, serveur) VALUES (:pseudo, :methode, :action, :serveur)');
					$req->execute(array(
						'pseudo' => $pseudo,
						'methode' => $lectureVotes['methode'],
						'action' => $lectureVotes['action'],
						'serveur' => $lectureVotes['serveur']
					));

				
				}else {
					// give direct la récompense
					
					 $action = explode(':', $lectureVotes['action'], 2);
					 if($action[0] == "give")
					 {
						$action = explode(':', $action[1]);
						$idI = $action[1];
						$quantite = $action[3];
						if(!empty($lectureVotes['message']))
						{
							$message = str_replace('{JOUEUR}', $pseudo, str_replace('{QUANTITE}', $quantite, str_replace('{ID}', $idI, str_replace('&amp;', '§', $lectureVotes['message']))));
						}
						if($lectureVotes['methode'] == 2)
						{
							if(!empty($lectureVotes['message']))
							{
								$jsonCon[$lectureVotes['serveur']]->SendBroadcast($message);
							}
							$jsonCon[$lectureVotes['serveur']]->GivePlayerItem($pseudo.' '.$idI . ' ' .$quantite);
				
						}
						else
						{
							for($j =0; $j < count($jsonCon); $j++)
							{
								if(!empty($lectureVotes['message']))
								{

									$jsonCon[$j]->SendBroadcast($message);
								}
								$jsonCon[$j]->GivePlayerItem($pseudo.' '.$idI . ' ' .$quantite);
							}
				
						}
					 }
					else if($action[0] == "jeton")
					 {
						 if(!empty($lectureVotes['message']))
						{
							$message = str_replace('{JOUEUR}', $pseudo, str_replace('{QUANTITE}', $action[1], str_replace('&amp;', '§', $lectureVotes['message'])));
						}
						if($lectureVotes['methode'] == 2)
						{
							if(!empty($lectureVotes['message']))
							{
								$jsonCon[$lectureVotes['serveur']]->SendBroadcast($message);
							}
							ajouterTokens($action[1]);
						
						}
						else
						{
							for($j =0; $j < count($jsonCon); $j++)
							{
								if(!empty($lectureVotes['message']))
								{
									$jsonCon[$j]->SendBroadcast($message);
								}
							}
							ajouterTokens($action[1]);
							
						}
					 }
					 else
					 {
						$cmd = str_replace('{JOUEUR}', $pseudo, $action[1]);
						if(!empty($lectureVotes['message']))
						{
							$message = str_replace('{JOUEUR}', $pseudo, str_replace('{CMD}', $cmd, str_replace('&amp;', '§', $lectureVotes['message'])));
						}
						if($lectureVotes['methode'] == 2)
						{
							if(!empty($lectureVotes['message']))
							{
								$jsonCon[$lectureVotes['serveur']]->SendBroadcast($message);
							}
							$jsonCon[$lectureVotes['serveur']]->runConsoleCommand($cmd);
					
						}
						else
						{
							for($j = 0; $j < count($jsonCon); $j++)
							{
								if(!empty($lectureVotes['message']))
								{
									$jsonCon[$j]->SendBroadcast($message);
								}
								$jsonCon[$j]->runConsoleCommand($cmd);
							}
							
						}
					 }
				}
				echo "success";
				
			}
			else {
				echo 'erreur-1';
			}
}else 
{
	echo 'erreur-2';
}

	function ajouterTokens($number){
		global $playerData, $joueurMaj, $_Joueur_;
		$playerData['tokens'] = $playerData['tokens'] + $number;
		$joueurMaj->setReponseConnection($playerData);
	 	$joueurMaj->setNouvellesDonneesTokens($playerData);
	 	$_Joueur_['tokens'] = $_Joueur_['tokens'] + $number;
	 	$_SESSION['Player']['tokens'] = $_Joueur_['tokens']; 
	 }
	
	function verifVote($url, $id) 
	{		if(isset($id) AND !empty($id) and $id != "")
		{
			if(strpos($url, 'serveur-prive.net'))
			{
				$API_call = @file_get_contents("https://serveur-prive.net/api/vote/".$id."/".get_client_ip());
				return $API_call == 1;
			} else if(strpos($url, 'serveurs-minecraft.org'))
			{
				$is_valid_vote = file_get_contents('https://www.serveurs-minecraft.org/api/is_valid_vote.php?id='.$id.'&ip='.get_client_ip().'&duration=5');
				return $is_valid_vote > 0;
			} else if(strpos($url, 'serveurs-minecraft.com'))
			{
				$apiaddr = 'https://serveurs-minecraft.com/api.php?Classement=' . $id .'&ip=' . get_client_ip();
				$apiResult = @file_get_contents($apiaddr);
				if ($apiResult!==false) {
					$apiResult = json_decode($apiResult, true);
					$currentDate = new DateTime($apiResult['reqVote']['date']);
					$voteDate = new DateTime($apiResult['lastVote']['date']);
					$interval = $currentDate->diff($voteDate);
					if ($interval->y==0 && $interval->m==0 && $interval->d<1 && !$apiResult['authorVote']) 
					{
						return true;
					}
				}
				return false;
			} else if(strpos($url, 'serveursminecraft.fr'))
			{
				$data = file_get_contents ( "https://serveursminecraft.fr/api/api.php?IDServeur=" . $id . "&IP=" . get_client_ip());
				if ( $data == false )
				{
					return false;
				}
				else
				{
					$data_decoded = json_decode($data,true);
					if ( $data_decoded["DateVote"] >= $data_decoded["DateActuelle"] - 360 )
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}else if(strpos($url, 'liste-minecraft-serveurs.com'))
			{
				$api = json_decode(file_get_contents("https://www.liste-minecraft-serveurs.com/Api/Worker/id_server/".$id."/ip/".get_client_ip()));
				if($api->result == 202){
					return true;
				}else{
					return false;
				}
			} else if(strpos($url, 'liste-serveurs.fr'))			{				$api = json_decode(file_get_contents("https://www.liste-serveurs.fr/api/checkVote/".$id."/".get_client_ip()));				if($api->success == true){					return true;				}else{					return false;				}			}else if(strpos($url, 'liste-serveurs.fr'))
			{
				$api = json_decode(file_get_contents("https://www.liste-serveur.fr/api/hasVoted/".$id."/".get_client_ip()));
				if($api->hasVoted == true){
					return true;
				}else{
					return false;
				}
			}else {
				return true;
			}		} else {			return true;		}
	}
	
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	//function RecupJoueur($pseudo, $id, $bddConnection)
	//{
	//	$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
	//	$line->execute(array(
	//		'pseudo' => $pseudo,
	//		'site' => $id	));
	//	$donnees = $line->fetch(PDO::FETCH_ASSOC);	
	//	return $donnees;
	//}
	
	function RecupJoueur($pseudo, $id, $bddConnection)
    {
        $line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
        $line->execute(array(
            'pseudo' => $pseudo,
            'site' => $id    ));
        $donnees = $line->fetch(PDO::FETCH_ASSOC);
        $line2 = $bddConnection->prepare('SELECT id FROM cmw_votes_config WHERE id = :site');
        $line2->execute(array(
            'site' => $id
        ));
        $donnees2 = $line2->fetch(PDO::FETCH_ASSOC);
        if($donnees2['id'] != $id)
            $donnees["existe"] = false;
        else
            $donnees["existe"] = true;
        return $donnees;
    }
	
	function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
    {
        return $donnees['date_dernier'] + $temps < time() && $donnees["existe"];
    }

	
	function GetTempsRestant($temps, $tempsTotal, $donnees)
	{
		$tempsEcoule = time() - $temps;
		$tempsRestant = $tempsTotal - $tempsEcoule;
		$tempsH = 0;
		$tempsM = 0;
		while($tempsRestant >= 3600)
		{
			$tempsH = $tempsH + 1;
			$tempsRestant = $tempsRestant - 3600;
		}
		while($tempsRestant >= 60)
		{
			$tempsM = $tempsM + 1;
			$tempsRestant = $tempsRestant - 60;
		}
		return $tempsH. ':' .$tempsM;
	}

	function LectureVote($id, $bddConnection)
	{
		$req = $bddConnection->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
		$req->execute(array('id' => $id));
		return $req->fetch(PDO::FETCH_ASSOC);
	}
?>
