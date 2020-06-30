<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'members', 'actions', 'editMember')) { 

	$allChange= explode('_', $_POST['allid']);
	
	foreach ($allChange as $id)
	{
		echo $id;
		ValiderChangement($_POST['pseudo'.$id], $_POST['email'.$id], $_POST['rang'.$id], $_POST['tokens'.$id], $id, $bddConnection);
		if(isset($_POST['password' . $id]) && !empty($_POST['password' . $id]) && $_POST['password' . $id] != "" && $_POST['password' . $id] != " ")
		{
			ChangerMdp($_POST['password' . $id], $id, $bddConnection);
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