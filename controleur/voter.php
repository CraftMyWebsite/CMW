<?php
$id = $_POST['site'];


include('controleur/topVoteurs.php');

if(!ExistPost($id, $liensVotes))
	header('Location: ?&page=voter&erreur=3');
	
	
if(isset($_Joueur_['pseudo']))
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
		
		if($lectureVotes['methode'] == 2)
		{
			$jsonCon[$liensVotes[$id]['serveur']]->SendBroadcast($message);
			$jsonCon[$liensVotes[$id]['serveur']]->GivePlayerItem($lectureVotes['id'] . ' ' .$lectureVotes['quantite']);
		}
		else
			for($j =0; $j < count($jsonCon); $j++)
			{
				$jsonCon[$j]->SendBroadcast($message);
				$jsonCon[$j]->GivePlayerItem($lectureVotes['id'] . ' ' .$lectureVotes['quantite']);
			}
		$succes = true;
	}


if($succes == true)
{
	header('Location: ?page=voter&success=true');
}
}
else
{
	header('Location: ?&page=voter&erreur=2');
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