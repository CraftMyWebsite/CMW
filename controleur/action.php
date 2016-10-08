<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/
if(isset($_GET['action']))
{
	switch ($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{ 		
		// Appellée quand on clique sur un bouton de déconnection (bouton disponible quand connecté.
		case 'deco': 
			// Destruction des sessions + redirection sur l'accueil.
			session_destroy();
			header('Location: index.php');
		break;
		
		// Appellé lorsqu'on envoie un formulaire de conneciton.
		case 'connection': 
			// On appelle la classe qui gère la connection et redirection...
			require_once('controleur/joueur/connection.php');
		break;
		
		// Comme connection mais pour les inscriptions
		case 'inscription':
			include('controleur/joueur/inscription.php');
		break;
		
        case 'changeMdp':
            include('controleur/joueur/changeMdp.php');
            header('Location: index.php');
        break;
		
		case 'passRecoverConfirm':
            include('controleur/joueur/recuperationMailLink.php');
            header('Location: index.php');
        break;

		case 'passRecover':
            include('controleur/joueur/changeMdpMail.php');
            //header('Location: index.php');
        break;
		// Appellé lorsqu'on appuie sur le bouton "acheter" d'un produit. L'id de l'offre est aussi passé en argument(sinon une erreur doit être gérée pour éviter que ça plante).
		case 'achat':
			include('controleur/boutique/achat.php');
			// Cette fois on redirige sur la boutique(car c'est la dernière page visitée avant l'action.
			header('Location: ?&page=boutique');
		break;
		
		// Même principe que la boutique, mais sur la page "tokens" dans la section PayPal.
		case 'achatPaypal':
			// On traite l'erreur de l'offre(comme boutique).
			if(isset($_GET['offer']))
				include('controleur/paypal/index.php');
			else
				header('Location: index.php'); // Simple redirection en cas d'erreur.
		break;
		
		// Même principe que la boutique, mais sur la page "tokens" dans la section PayPal.
		case 'verif_paypal':
		include('controleur/paypal/verif_paypal.php');
		break;
		
		// Lorsque paypal renvoie le Token au serveur(PHP Curl).
		case 'achatPaypalReturn':
			include('controleur/paypal/return.php');
			header('Location: index.php');
		break;
		
		// Appellé lorsqu'un code dedipass est validé.
		case 'dedipass':
			include('controleur/dedipass.php');
		break;
		
		case 'monelib':
			include('controleur/tokens/monelib.php');
			// On redirige sur la page d'achat de token, le joueur vas surrement racheter un code(quoi !? Pas le droit de rêver?).
			//header('Location: &page=token');
		break;
		
		// Appellé quand le joueur valide son vote. Action issue d'un formulaire. Les autres infos sont en POST et non en GET.
		case 'voter':
			include('controleur/voter.php');
		break;
		
		case 'post_ticket':
			include('controleur/support/ticket.php');
			header('Location: index.php?&page=support');
		break;
		
		case 'post_ticket_commentaire':
			include('controleur/support/ticketCommentaire.php');
			header('Location: index.php?&page=support');
		break;
		
		case 'changeProfil':
			include('controleur/joueur/changeProfil.php');
			//header('Location: index.php?&page=profil&profil=' .$_Joueur_['pseudo']);
		break;
		
		case 'changeProfilAutres':
			include('controleur/joueur/changeProfilAutres.php');
		break;
		
		case 'ticketEtat':
			include('controleur/support/ticketEtat.php');
			header('Location: index.php?&page=support');
		break;

		case 'post_news_commentaire':
			include('controleur/accueil/newsCommentaire.php');
		break;

		case 'edit_news_commentaire':
			include('controleur/accueil/newsEditCommentaire.php');
		break;

		case 'delete_news_commentaire':
			include('controleur/accueil/newsDeleteCommentaire.php');
		break;

		case 'report_news_commentaire':
			include('controleur/accueil/newsReport.php');
		break;

		case 'likeNews':
            include('controleur/accueil/newsLike.php');
        break;
        
		case 'validationMail':
			include('controleur/joueur/validationMail.php');
		break;
		
		// Si le joueur a rentré un url contenant une valeur d'action innexistant?
		default:
			header('Location: index.php');
	}
}
?>
