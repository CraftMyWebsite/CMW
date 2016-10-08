<?php
if(isset($_POST['pseudo']) AND isset($_POST['mdp']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']))
{
	$_POST['mdp'] = md5(sha1($_POST['mdp']));
	$get_Pseudo = $_POST['pseudo'];

	$bddConnection = $base->getConnection();
	require_once('modele/joueur/connection.class.php');
	$userConnection = new Connection($_POST['pseudo'], $bddConnection);
	$ligneReponse = $userConnection->getReponseConnection();
	
	$donneesJoueur = $ligneReponse->fetch();
	if(empty($donneesJoueur))
	{
		header('Location: ?&page=erreur&erreur=5');
	}
	else
	{
		if($donneesJoueur['mdp'] == $_POST['mdp'])
		{
			require_once('modele/joueur/ScriptBySprik07/reqVerifMailBDD.class.php');
			$req_verifMailBdd = new VerifMailBdd($get_Pseudo, $bddConnection);
			$rep_verifMailBdd = $req_verifMailBdd->getReponseConnection();
			$get_verifMailBdd = $rep_verifMailBdd->fetch();
			$VerifMailBdd = $get_verifMailBdd['ValidationMail'];

			if($VerifMailBdd == '1')
			{
				require_once('controleur/joueur/joueurcon.class.php');
				$utilisateur_connection = new JoueurCon($donneesJoueur['id'], $donneesJoueur['pseudo'], $donneesJoueur['email'], $donneesJoueur['rang'], $donneesJoueur['tokens']);
				header('Location: index.php');
			}
			else
			{
				header('Location: ?&page=erreur&erreur=14');
			}
		}
		else 
		{ 
			header('Location: ?&page=erreur&erreur=6');
		}
	}
}
else
{
	header('Location: ?&page=erreur&erreur=4');
}
?>
