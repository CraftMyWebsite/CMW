<?php
$messagesErreur = Array(
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Un des champs est invalide ou incomplet',
		'message' => 'Nous sommes désolé mais le formulaire n\'a pas été remplis correctement, merci de réessayer...' ),
	
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Cet utilisateur existe déjà...',
		'message' => 'Si vous disposez du compte avec le pseudo que vous avez inscrit et qu\'un joueur vous a volé votre compte, signalez un administrateur.' ),
	
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Pseudo trop long',
		'message' => 'Votre pseudo ne doit pas dépasser les 16 caractères... Utilisez un pseudo plus court !' ),
	
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Mot de passe',
		'message' => 'Les deux mot de passe entrés ne correspondent pas...' ),
	
	Array(
		'type' => 'Erreur: Connexion',
		'titre' => 'Un des champs est invalide ou incomplet',
		'message' => 'Nous sommes désolé mais le formulaire n\'a pas été remplis correctement, merci de réessayer...' ),
	
	Array(
		'type' => 'Erreur: Connexion',
		'titre' => 'Utilisateur Inexistant',
		'message' => 'Le pseudo que vous avez entré n\'existe pas, si c\'est le votre, inscrivez vous avec !' ),
	
	Array(
		'type' => 'Erreur: Connexion',
		'titre' => 'Mauvais mot de passe...',
		'message' => 'Le mot de passe rentré est incorrect... Si vous êtes le propriétaire du compte, vous pouvez changer votre mot de passe en suivant les étapes suivantes: 
		<ul>
			<li>Inscrivez votre adresse mail ici : <form action="?action=passRecover" method="post"><input type="email" name="email" /><input type="submit" value="Valider"/></form></li>
			<li>Si nous reconnaissons votre adresse mail, vous recevrez votre mot de passe par mail ! </li>
			<li>Le mail peut mettre jusqu\'a 5 minutes pour arriver !</li>
			<li>Vous recevrez d\'abord un mail de confirmation de changement du mot de passe puis un nouveau mot de passe toujours par mail vous sera adressé ! </li>
		</ul>' ),
	Array(
		'type' => 'Erreur: Connexion',
		'titre' => 'Mauvais mot de passe...',
		'message' => 'Le mot de passe rentré est incorrect... Si vous êtes le propriétaire du compte, vous pouvez changer votre mot de passe en suivant les étapes suivantes: 
		<ul>
			<li>Inscrivez votre adresse mail ici : <form action="?action=passRecover" method="post"><input type="email" name="email" /><input type="submit" value="Valider"/></form></li>
			<li>Si nous reconnaissons votre adresse mail, vous recevrez votre mot de passe par mail ! </li>
			<li>Le mail peut mettre jusqu\'a 5 minutes pour arrivée !</li>
			<li>Vousq recevrez d\'abord un mail de confirmation de changement du mot de passe puis un nouveau mot de passe toujours par mail vous sera adressé ! </li>
		</ul>' ),
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Captcha incorrect',
		'message' => 'Le captcha entré est incorrect...'),
	Array(
		'type' => 'Erreur: Récupération de mot de passe',
		'titre' => 'Le token entré est invalide',
		'message' => 'Votre token de récupération est invalide, veuillez réessayez la récupération.' ),
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Adresse IP déjà inscrit.',
		'message' => 'Interdiction d"avoir un double compte.' ),
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Adresse email est incorrect.',
		'message' => 'Votre adresse est pas conforme.' ),
	Array(
		'type' => "Erreur: URL invalide",
		'titre' => "L'URL est invalide.",
		'message' => "L'adresse de la page souhaitez est invalide ou inexistant." ),
	Array(
		'type' => "Erreur: Compte déjà actif",
		'titre' => "Compte déjà activé.",
		'message' => "Votre compte est déjà actif sur le site." ),
	Array(
		'type' => "Erreur: Compte inactif",
		'titre' => "Compte inactif.",
		'message' => "Votre compte n'est pas activé sur le site." ),
	Array(
		'type' => 'Erreur: Création du compte',
		'titre' => 'Email déjà en utilisation.',
		'message' => 'Votre adresse email que vous aviez rentrée est déjà utilisé.' ),
	);


if(isset($_GET['page']) AND $_GET['page'] == 'erreur' AND isset($_GET['erreur']))
{
	$erreurID = (int)$_GET['erreur'];
	$erreur = $messagesErreur[$erreurID];
}
else
{
	$erreur['type'] = '404 Not Found';
	$erreur['titre'] = 'Page introuvable';
	$erreur['message'] = 'Nous sommes désolés mais la page que vous avez demmandé n\'existe pas (ou plus)...';
}

?>
