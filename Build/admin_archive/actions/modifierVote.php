<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote'))
{
	$req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config');
	$data = $req_donnees->fetchAll();
	for($i=0; $i <= count($data); $i++)
	{
		$titre = htmlspecialchars($_POST['titre'.$i]);
		$lien = htmlspecialchars($_POST['lien'.$i]);
		$serveur = htmlspecialchars($_POST['serveur'.$i]);
		$methode = htmlspecialchars($_POST['methode'.$i]);
		$action = htmlspecialchars($_POST['action'.$i]);
		$message = htmlspecialchars($_POST['message'.$i]);
		$temps = htmlspecialchars($_POST['temps'.$i]);
		$idCustom = htmlspecialchars($_POST['idCustom'.$i]);

		$enligne = $_POST['enligne'.$i];
		if($action == 1)
		{
			$action = 'cmd';
			$cmd = htmlspecialchars($_POST['cmd'.$i]);
			if(!Verif($idCustom, $enligne, $titre, $lien, $serveur, $methode, $action, $message, $temps, $data[$i], $cmd) == true)
			{
				$update = $bddConnection->prepare('UPDATE cmw_votes_config SET message = :message, methode = :methode, action = :action, serveur = :serveur, lien = :lien, temps = :temps, titre = :titre, idCustom = :idCustom, enligne = :enligne WHERE id = :id');
				$update->execute(array(
					'message' => $message,
					'methode' => $methode,
					'action' => 'cmd:'.$cmd,
					'serveur' => $serveur,
					'lien' => $lien,
					'temps' => $temps,
					'titre' => $titre,
					'idCustom' => $idCustom,
					'enligne' => $enligne,
					
					'id' => $data[$i]['id']
				));
			}
		}
		elseif($action == 2)
		{
			$action = 'give';
			$quantite = htmlspecialchars($_POST['quantite'.$i]);
			$id = htmlspecialchars($_POST['id'.$i]);
			if(!Verif($idCustom, $enligne, $titre, $lien, $serveur, $methode, $action, $message, $temps, $data[$i], $quantite, $id) == true)
			{
				$update = $bddConnection->prepare('UPDATE cmw_votes_config SET message = :message, methode = :methode, action = :action, serveur = :serveur, lien = :lien, temps = :temps, titre = :titre, idCustom = :idCustom, enligne = :enligne WHERE id = :id');
				$update->execute(array(
					'message' => $message,
					'methode' => $methode,
					'action' => 'give:id:'.$id.':quantite:'.$quantite,
					'serveur' => $serveur,
					'lien' => $lien,
					'temps' => $temps,
					'titre' => $titre,
					'idCustom' => $idCustom,
					'enligne' => $enligne,
					'id' => $data[$i]['id']
					
				));
			}
		}
		else
		{
			$action = 'jeton';
			$quantite = htmlspecialchars($_POST['quantite'.$i]);
			if(!Verif($idCustom, $enligne, $titre, $lien, $serveur, $methode, $action, $message, $temps, $data[$i], $quantite) == true)
			{
				$update = $bddConnection->prepare('UPDATE cmw_votes_config SET message = :message, methode = :methode, action = :action, serveur = :serveur, lien = :lien, temps = :temps, titre = :titre, idCustom = :idCustom, enligne = :enligne WHERE id = :id');
				$update->execute(array(
					'message' => $message,
					'methode' => $methode,
					'action' => 'jeton:'.$quantite,
					'serveur' => $serveur,
					'lien' => $lien,
					'temps' => $temps,
					'titre' => $titre,
					'idCustom' => $idCustom,
					'enligne' => $enligne,
					'id' => $data[$i]['id']
				));
			}
		}		
	}
}
function Verif($idCustom, $enligne, $titre, $lien, $serveur, $methode, $action, $message, $temps, $donnees, $arg1, $arg2 = null)
{
	$data_action = explode(':', $donnees['action'], 2);
	if($data_action[0] != 'give')
	{
		$data_arg1 = $data_action[1];
		$data_arg2 = null;
	}
	else
	{
		$data_action2 = explode(':', $donnees['action'][1]);
		$data_arg1 = $data_action2[3];
		$data_arg2 = $data_action2[1];
	}
	if($idCustom == $donnees['idCustom'] && $enligne == $donnees['enligne'] && $titre == $donnees['titre'] && $lien == $donnees['lien'] && $serveur == $donnees['serveur'] && $methode == $donnees['methode'] && $action == $data_action[0] && $message == $donnees['message'] && $data_arg1 == $arg1 && $arg2 == $data_arg2)
		return true;
	else
		return false;
}
