<?php
for($i = 0; $i < $_POST['nombreUsers']; $i++)
{
	if(isset($_POST['pseudo' . $i]) AND isset($_POST['email' . $i]) AND isset($_POST['rang' . $i]) AND isset($_POST['jetons' . $i]))
	{
		$pseudo = $_POST['pseudo' . $i];
		$email = $_POST['email' . $i];
		$rang = $_POST['rang' . $i];
		$jetons = $_POST['jetons' . $i];
		
		if($pseudo != $membres[$i]['pseudo'] OR $email != $membres[$i]['email'] OR $rang != $membres[$i]['rang'] OR $jetons != $membres[$i]['jetons'])
			ValiderChangement($pseudo, $email, $rang, $jetons, $membres[$i]['id'], $bddConnection);
			
		if(isset($_POST['mdp' . $i]) and !empty($_POST['mdp' . $i]))
			ChangerMdp($_POST['mdp' . $i], $membres[$i]['id'], $bddConnection);
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
		'id' => $id,	));
}

function ChangerMdp($mdp, $id, $bdd)
{
	$mdp = md5(sha1($mdp));
	$reqChangeMdp = $bdd->prepare('UPDATE cmw_users SET mdp = :mdp WHERE id = :id');
	$reqChangeMdp->execute( Array(
		'mdp' => $mdp,
		'id' => $id,	));
}
?>