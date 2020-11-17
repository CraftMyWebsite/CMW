<?php
if(isset($_POST['pseudo']) AND isset($_POST['mdp']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']))
{
	$_POST['mdp'] = htmlspecialchars_decode($_POST['mdp']);
	$get_Pseudo = $_POST['pseudo'];

	$bddConnection = $base->getConnection();
	require_once('modele/joueur/connection.class.php');
	$userConnection = new Connection($_POST['pseudo'], $bddConnection);
	$ligneReponse = $userConnection->getReponseConnection();
	
	$donneesJoueur = $ligneReponse->fetch(PDO::FETCH_ASSOC);
	if(!empty($donneesJoueur))
	{
		if(password_verify($_POST['mdp'], $donneesJoueur['mdp']))
		{
			require_once('modele/joueur/ScriptBySprik07/reqVerifMailBDD.class.php');
			$req_verifMailBdd = new VerifMailBdd($get_Pseudo, $bddConnection);
			$rep_verifMailBdd = $req_verifMailBdd->getReponseConnection();
			$get_verifMailBdd = $rep_verifMailBdd->fetch(PDO::FETCH_ASSOC);
			$VerifMailBdd = $get_verifMailBdd['ValidationMail'];

			if($VerifMailBdd == '1')
			{
				require_once('controleur/joueur/joueurcon.class.php');
				$reconnexion = NULL;
				if(isset($_POST['reconnexion']))
					$reconnexion = 1;
				$utilisateur_connection = new JoueurCon($donneesJoueur['id'], $donneesJoueur['pseudo'], $donneesJoueur['email'], $donneesJoueur['rang'], $donneesJoueur['tokens'], $reconnexion, $donneesJoueur['mdp']);
				if(preg_match('#erreur#', $_SERVER['HTTP_REFERER']))
				{
					header('Location: index.php');
				}
				else
				{
					header('Location: '.$_SERVER['HTTP_REFERER']);
				}
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
	else
	{
		header('Location: ?&page=erreur&erreur=5');
	}
}
else
{
	header('Location: ?&page=erreur&erreur=4');
}
?>
