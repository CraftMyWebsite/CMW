<?php

$id = $_POST['site'];
$id = $id - 1;
require_once('modele/joueur/maj.class.php');
include('controleur/topVoteurs.php');
$joueurMaj = new Maj($_Joueur_['pseudo'], $bddConnection);
$playerData = $joueurMaj->getReponseConnection();
$playerData = $playerData->fetch();

if(!ExistPost($id, $liensVotes))
	header('Location: ?&page=voter&erreur=3');
	
	
if(isset($_Joueur_['pseudo']) && $_POST['site'] > 0)
{


for($i = 0; $i < count($lecture['Json']); $i++)
{
	$jsonCon[$i]->SetConnectionBase($bddConnection);
}

if(!ExisteJoueur($_Joueur_['pseudo'], $id, $bddConnection))
	CreerJoueur($_Joueur_['pseudo'], $id, $bddConnection);

$donnees = RecupJoueur($_Joueur_['pseudo'], $id, $bddConnection);

$succes = false;
		if(!Vote($_Joueur_['pseudo'], $id, $bddConnection, $donnees, $liensVotes[$id]['temps']))
		{
			header('Location: ?&page=voter&erreur=1&time=' .GetTempsRestant($donnees['date_dernier'], $liensVotes[$id]['temps'], $donnees));
		}
		else
		{
			$lectureVotes = new Lire('modele/config/configVotes.yml');
			$lectureVotes = $lectureVotes->GetTableau();
			$message = str_replace('{JOUEUR}', $_Joueur_['pseudo'], str_replace('{QUANTITE}', $lectureVotes['quantite'], str_replace('{ID}', $lectureVotes['id'], $lectureVotes['message'])));
			$cmd = str_replace('{JOUEUR}', $_Joueur_['pseudo'], $lectureVotes['cmd']);
			
			if($lectureVotes['action'] == 2)
			{
				if($lectureVotes['methode'] == 2)
				{
					if($lectureVotes['display'] == 1)
					{
						$jsonCon[$liensVotes[$id]['serveur']]->SendBroadcast($message);
					}
					$jsonCon[$liensVotes[$id]['serveur']]->GivePlayerItem($lectureVotes['id'] . ' ' .$lectureVotes['quantite']);
					header('Location: ?&page=voter&success=true');
				}
				else
				{
					for($j =0; $j < count($jsonCon); $j++)
					{
						if($lectureVotes['display'] == 1)
						{
							$jsonCon[$j]->SendBroadcast($message);
						}
						$jsonCon[$j]->GivePlayerItem($lectureVotes['id'] . ' ' .$lectureVotes['quantite']);
					}
				header('Location: ?&page=voter&success=true');
				}
			}
			elseif($lectureVotes['action'] == 3)
			{
				if($lectureVotes['methode'] == 2)
				{
					if($lectureVotes['display'] == 1)
					{
						$jsonCon[$liensVotes[$id]['serveur']]->SendBroadcast($message);
					}
					ajouterTokens($lectureVotes['tokens']);
					header('Location: ?&page=voter&success=true');
				}
				else
				{
					for($j =0; $j < count($jsonCon); $j++)
					{
						if($lectureVotes['display'] == 1)
						{
							$jsonCon[$j]->SendBroadcast($message);
						}
						ajouterTokens($lectureVotes['tokens']);
					}
				header('Location: ?&page=voter&success=true');
				}
			}
			else
			{
				if($lectureVotes['action'] == 1)
				{
					if($lectureVotes['methode'] == 2)
					{
						if($lectureVotes['display'] == 1)
						{
							$jsonCon[$liensVotes[$id]['serveur']]->SendBroadcast($message);
						}
						$jsonCon[$liensVotes[$id]['serveur']]->runConsoleCommand($cmd);
					header('Location: ?&page=voter&success=true');
					}
					else
					{
						for($j = 0; $j < count($jsonCon); $j++)
						{
							if($lectureVotes['display'] == 1 )
							{
								$jsonCon[$j]->SendBroadcast($message);
							}
							$jsonCon[$j]->runConsoleCommand($cmd);
						}
						header('Location: ?&page=voter&success=true');
					}
				}
			}
		}
	}
	else 
	{
		header('Location: ?&page=voter&erreur=2');
	}

	function ajouterTokens($number){
		global $playerData, $joueurMaj, $_Joueur_;
		$playerData['tokens'] = $playerData['tokens'] + $number;
		$joueurMaj->setReponseConnection($playerData);
		$joueurMaj->setNouvellesDonneesTokens($playerData);
		$_Joueur_['tokens'] = $_Joueur_['tokens'] + $number;
		$_SESSION['Player']['tokens'] = $_Joueur_['tokens']; 
	}
	
	function ExistPost($id, $votesLiens)
	{
		if(isset($votesLiens[$id]))
			return true;
		else return false;
	}

	function RecupJoueur($pseudo, $id, $bddConnection)
	{
		$line = $bddConnection->prepare('SELECT * FROM cmw_votes WHERE pseudo = :pseudo AND site = :site');
		$line->execute(array(
			'pseudo' => $pseudo,
			'site' => $id	));
		$donnees = $line->fetch();	
		return $donnees;
	}
	
	function Vote($pseudo, $id, $bddConnection, $donnees, $temps)
	{
		if($donnees['date_dernier'] + $temps < time())
		{
			$req = $bddConnection->prepare('UPDATE cmw_votes SET nbre_votes = nbre_votes + 1, date_dernier = :tmp WHERE pseudo = :pseudo AND site = :site');
			$req->execute(array(
				'tmp' => time(),
				'pseudo' => $pseudo,
				'site' => $id	));
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
			
		$donnees = $line->fetch();
		
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
		return $tempsH. ':' .$tempsM;
	}
?>