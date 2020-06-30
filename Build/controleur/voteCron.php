<?php

if(isset($_GET['mdp']) AND isset($_Serveur_['VoteCron']['mdp']) AND $_Serveur_['VoteCron']['mdp'] == htmlspecialchars($_GET['mdp']) )
{
	foreach($jsonCon as $i => $serveur)
	{
		$serveurStats[$key] = $serveur->GetServeurInfos();
		$req_vote->execute(array('serveur' => $i));
		$count_req->execute(array('serveur' => $i));
		$data_count = $count_req->fetch();
		if($data_count['count'] > 0)
		{
			foreach ($serveurStats[$i]['joueurs'] as $cle => $element) 
			{ 
			
				
				if(!ExisteJoueur2($serveurStats[$i]['joueurs'][$cle],$bddConnection) && $_Serveur_['VoteCron']['sendtoall'] == 0)
				{
					continue;
				}
				if(!empty($_Serveur_['VoteCron']['entete']))
				{
					$serveur->SendMessage(array($serveurStats[$i]['joueurs'][$cle], str_replace('&','§', $_Serveur_['VoteCron']['entete'])));
				}
				while($liensVotes = $req_vote->fetch())
				{ 
					$id = $liensVotes['id'];
					$lectureVotes = LectureVote($id, $bddConnection);
					$lien = explode('/',str_replace('https://', '', str_replace('http://', '', $liensVotes['lien'])));
					if(!ExisteJoueur($serveurStats[$i]['joueurs'][$cle], $id, $bddConnection))
					{
					
						CreerJoueur($serveurStats[$i]['joueurs'][$cle], $id, $bddConnection);
						$donnees = RecupJoueur($serveurStats[$i]['joueurs'][$cle], $id, $bddConnection);
						$serveur->SendMessage(array($serveurStats[$i]['joueurs'][$cle], str_replace('{LIEN}', $lien[0],str_replace('&','§', $_Serveur_['VoteCron']['msgallow']))));
					}
					else {
						$donnees = RecupJoueur($serveurStats[$i]['joueurs'][$cle], $id, $bddConnection);
						if(!Vote($serveurStats[$i]['joueurs'][$cle], $id, $bddConnection, $donnees, $lectureVotes['temps']))
						{
							$serveur->SendMessage(array($serveurStats[$i]['joueurs'][$cle], str_replace('{TEMPS}',
							GetTempsRestant($donnees['date_dernier'],$lectureVotes['temps'], $donnees), 
							str_replace('&','§', str_replace('{LIEN}', $lien[0],$_Serveur_['VoteCron']['msgdeny'])))));
						}
						else
						{
							$serveur->SendMessage(array($serveurStats[$i]['joueurs'][$cle], str_replace('{LIEN}', $lien[0],str_replace('&','§', $_Serveur_['VoteCron']['msgallow']))));
						}
						
					}
					$first =false;
					
				}
				if(!empty($_Serveur_['VoteCron']['footer']))
				{
					$serveur->SendMessage(array($serveurStats[$i]['joueurs'][$cle], str_replace('&','§', $_Serveur_['VoteCron']['footer'])));
				}
			}
		}
		
	}

}
	function RecupJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
		$donnees = $line->fetch(PDO::FETCH_ASSOC);	
		return $donnees;
	}
	
	function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
	{
		if($donnees['date_dernier'] + $temps < time())
		{
			return true;
		}
		else 
			return false;
	}
	
	function ExisteJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
			
		$donnees = $line->fetch(PDO::FETCH_ASSOC);
		
		if(empty($donnees['pseudo']))
			return false;
		else
			return true;
	}
	
	function ExisteJoueur2($pseudo,$bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo');
		$line->execute(array(
			'pseudo' => $pseudo));
			
		$donnees = $line->fetch(PDO::FETCH_ASSOC);
		
		if(empty($donnees['pseudo']))
			return false;
		else
			return true;
	}
	
	function CreerJoueur($pseudo, $id, $bddConnection)
	{
		$req = $bddConnection->prepare('INSERT INTO cmw_votes(pseudo, site) VALUES(:pseudo, :site)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'site' => $id
			));
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
		if($tempsH == 0)
		{
			return $tempsM.' minute(s)';
		}
		else if ($tempsM <= 9)
		{
			return $tempsH. 'H0' .$tempsM;
		}
		else
		{
			return $tempsH. 'H' .$tempsM;
		}
	}

	function LectureVote($id, $bddConnection)
	{
		$req = $bddConnection->prepare('SELECT * FROM cmw_votes_config WHERE id = :id');
		$req->execute(array('id' => $id));
		return $req->fetch(PDO::FETCH_ASSOC);
	}
?>