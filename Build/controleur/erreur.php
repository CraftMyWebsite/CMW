<?php
function get_erreur($erreur, &$type, &$titre, &$contenue)
{
	switch($erreur)
	{
		case '0':
			$type = 'Erreur: Action quelconque';
			$titre = 'Un des champs est invalide ou incomplet';
			$contenue = 'Nous sommes désolé mais le formulaire n\'a pas été remplis correctement, merci de réessayer...';
		break;

		case '1':
			$type = 'Erreur: Création du compte';
			$titre = 'Cet utilisateur existe déjà...';
			$contenue = 'Si vous disposez du compte avec le pseudo que vous avez inscrit et qu\'un joueur vous a volé votre compte, signalez le à un administrateur.';
		break;

		case '2':
			$type = 'Erreur: Création du compte';
			$titre = 'Pseudo trop long';
			$contenue = 'Votre pseudo ne doit pas dépasser les 16 caractères... Utilisez un pseudo plus court !';
		break;

		case '3':
			$type = 'Erreur: Création du compte';
			$titre = 'Mot de passe';
			$contenue = 'Les deux mot de passe entrés ne correspondent pas...';
		break;

		case '4':
			$type = 'Erreur: Connexion';
			$titre = 'Un des champs est invalide ou incomplet';
			$contenue = 'Nous sommes désolé mais le formulaire n\'a pas été remplis correctement, merci de réessayer...';
		break;

		case '5':
			$type = 'Erreur: Connexion';
			$titre = 'Utilisateur Inexistant';
			$contenue = 'Le pseudo que vous avez entré n\'existe pas, si c\'est le votre, inscrivez vous avec !';
		break;

		case '6':
			$type = 'Erreur: Connexion';
			$titre = 'Mauvais mot de passe...';
			$contenue = 'Le mot de passe rentré est incorrect... Si vous êtes le propriétaire du compte, vous pouvez changer votre mot de passe en suivant les étapes suivantes:
						<ul>
							<li>Inscrivez votre adresse mail ici : <form action="?action=passRecover" method="post"><input type="email" name="email" /><input type="submit" value="Valider"/></form></li>
							<li>Si nous reconnaissons votre adresse mail, vous recevrez votre mot de passe par mail ! </li>
							<li>Le mail peut mettre jusqu\'à 5 minutes pour arrivée !</li>
							<li>Vous recevrez d\'abord un mail de confirmation de changement du mot de passe puis un nouveau mot de passe toujours par mail vous sera adressé ! </li>
						</ul>';
		break;

		case '7':
			$type= 'Erreur: Droits';
			$titre = 'Vous n\'avez pas les droits suffisants';
			$contenue = 'Désolé, mais vous n\'avez pas la permission d\'executer cette action !';
		break;

		case '8':
			$type = 'Erreur: Création du compte';
			$titre = 'Captcha incorrect';
			$contenue = 'Le captcha entré est incorrect...';
		break;

		case '9':
			$type = 'Erreur: Récupération de mot de passe';
			$titre = 'Le token entré est invalide';
			$contenue = 'Votre token de récupération est invalide, veuillez réessayez la récupération.';
		break;

		case '10':
			$type = 'Erreur: Création du compte';
			$titre = 'Adresse IP déjà inscrit.';
			$contenue = 'Interdiction d\'avoir un double compte.';
		break;

		case '11':
			$type = 'Erreur: Création du compte';
			$titre = 'Adresse email est incorrect.';
			$contenue = 'Votre adresse est pas conforme.';
		break;

		case '12':
			$type = "Erreur: URL invalide";
			$titre = "L'URL est invalide.";
			$contenue = "L'adresse de la page souhaitez est invalide ou inexistant.";
		break;

		case '13':
			$type = "Erreur: Compte déjà actif";
			$titre = "Compte déjà activé.";
			$contenue = "Votre compte est déjà actif sur le site.";
		break;

		case '14':
			$type = "Erreur: Compte inactif";
			$titre = "Compte inactif.";
			$contenue = "Votre compte n'est pas activé sur le site.";
		break;

		case '15':
			$type = 'Erreur: Création du compte';
			$titre = 'Email déjà en utilisation.';
			$contenue = 'Votre adresse email que vous aviez rentrée est déjà utilisé.';
		break;

		case '16':
			$type = 'Erreur: Utilisateur';
			$titre = 'Non connecté';
			$contenue = 'Vous devez être connecté pour pouvoir accéder à cette action ! ';
		break;

		case '17':
			$type = "Erreur Fatale";
			$titre = "Erreur fatale !";
			$contenue = "Une erreur indéterminé est survenu lors de l'exécution du script ! </br> Contacter immédiatement un administrateur !";
		break;

		case '18':
			$type = "Erreur Boutique";
			$titre = "Solde insuffisant";
			$contenue = "Votre solde n'est pas suffisant pour acheter ces items. <br/> Merci de renouvelle votre solde ici : <a href='?page=token' class='btn btn-primary link'>Acheter des jetons</a>";
		break;

		case '19':
			$type = htmlspecialchars($_GET['type']);
			$titre = htmlspecialchars($_GET['titre']);
			$contenue = htmlspecialchars($_GET['contenue']);
		break;

		case '20':
			$type = "Erreur Forum";
			$titre = "Topic trop long";
			$contenue = "Votre message contient trop de caractères";
		break;

		case '21':
			$type = "Erreur mail";
			$titre = "Le mail n'a pas pu être envoyé";
			$contenue= "Veuilliez contacter l'administrateur de cette erreur.";
		break;
		
		default:
			$type = '404 Not Found';
			$titre = 'Page introuvable';
			$contenue = 'Nous sommes désolés mais la page que vous avez demmandé n\'existe pas (ou plus)...';
		break;
	}
}
?>
