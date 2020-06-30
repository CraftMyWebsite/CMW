<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['actions']['editMember'] == true) { 
	for($i = 0; $i < $_POST['nombreUsers']; $i++)
	{
		if(isset($_POST['pseudo' . $i]) AND isset($_POST['email' . $i]) AND isset($_POST['rang' . $i]) AND isset($_POST['jetons' . $i]))
		{
			if($_POST['rang' . $i] != 1 OR $membres[$i]['rang'] != 1 OR $_Joueur_['rang'] == 1) {

				$pseudo = $_POST['pseudo' . $i];
				$email = $_POST['email' . $i];
				$rang = $_POST['rang' . $i];
				$jetons = $_POST['jetons' . $i];
				if($rang == 1 AND $membres[$i]['rang'] != 1 AND $_Joueur_['rang'] != 1)
					$rang = $membres[$i]['rang'];
				if($membres[$i]['rang'] == 1 && $rang != 1 && $_Joueur_['rang'] != 1)
					$rang = 1;

				if($pseudo != $membres[$i]['pseudo'] OR $email != $membres[$i]['email'] OR $rang != $membres[$i]['rang'] OR $jetons != $membres[$i]['jetons'])
					ValiderChangement($pseudo, $email, $rang, $jetons, $membres[$i]['id'], $bddConnection);
				
				if(isset($_POST['mdp' . $i]) and !empty($_POST['mdp' . $i]))
					ChangerMdp($_POST['mdp' . $i], $membres[$i]['id'], $bddConnection);

			}
		}
	}
}
function ValiderChangement($pseudo, $email, $rang, $jetons, $id, $bdd)
{
	$reqMajJoueur = $bdd->prepare('UPDATE cmw_users SET pseudo = :pseudo, email = :email, rang = :rang, tokens = :tokens WHERE id = :id');
	$reqMajJoueur->execute( Array(
		'pseudo' => $pseudo,
		'email' => $email,
		'rang' => $rang,
		'tokens' => $jetons,
		'id' => $id
	));
}

function ChangerMdp($mdp, $id, $bdd)
{
	$mdp = password_hash($mdp, PASSWORD_DEFAULT);
	$reqChangeMdp = $bdd->prepare('UPDATE cmw_users SET mdp = :mdp WHERE id = :id');
	$reqChangeMdp->execute( Array(
		'mdp' => $mdp,
		'id' => $id
	));
}
?>