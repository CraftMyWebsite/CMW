<?php

if(isset($_GET['mdp']) && isset($_Serveur_['VoteCron']['mdp']) && $_Serveur_['VoteCron']['mdp'] == $_GET['mdp'])
{

	foreach($lectureJSON as $key => $s)
	{
		$serveur = $jsonCon[$key];
		$info = $serveur->GetServeurInfos();
		foreach ($info['joueurs'] as $player) 
		{ 
			if(!ExisteJoueur2($player,$bddConnection) && $_Serveur_['VoteCron']['sendtoall'] == 0)
			{
				continue;
			}
			if($_Serveur_['VoteCron']['sendtoallserv'] == 1) {
				$lienInfo = $bddConnection->query('SELECT id, lien, titre, temps FROM cmw_votes_config');
			} else {
				$lienInfo = $bddConnection->prepare('SELECT id, lien, titre, temps FROM cmw_votes_config WHERE serveur = :serveur');
				$lienInfo->execute(array("serveur" => $s['id']));
			}
			if(!empty($_Serveur_['VoteCron']['entete']))
			{
				$serveur->SendMessage(array($player, str_replace('&','§', $_Serveur_['VoteCron']['entete'])));
			}

			foreach($lienInfo as $value) {
				$lien = explode('/',str_replace('https://', '', str_replace('http://', '', $value['lien'])));
				if(!ExisteJoueur($player, $value['id'], $bddConnection))
				{
					$serveur->SendMessage(array($player, str_replace('{LIEN}', $lien[0],str_replace('&','§', $_Serveur_['VoteCron']['msgallow']))));
				} else {
					$donnees = RecupJoueur($player, $value['id'], $bddConnection);
					if(!Vote($player, $value['id'], $bddConnection, $donnees, $value['temps']))
					{
						$serveur->SendMessage(array($player, str_replace('{TEMPS}',
							GetTempsRestant($donnees['date_dernier'],$value['temps'], $donnees), 
							str_replace('&','§', str_replace('{LIEN}', $lien[0],$_Serveur_['VoteCron']['msgdeny'])))));
					} else {
						$serveur->SendMessage(array($player, str_replace('{LIEN}', $lien[0],str_replace('&','§', $_Serveur_['VoteCron']['msgallow']))));
					}

				}

			}

			if(!empty($_Serveur_['VoteCron']['footer']))
			{
				$serveur->SendMessage(array($player, str_replace('&','§', $_Serveur_['VoteCron']['footer'])));
			}
		}
	}
}
	function RecupJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site and isOld=0');
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
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site and isOld=0');
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
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo and isOld=0');
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

?>