<?php
/*
	Ce fichier PHP affiche telle ou telle page selon selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/



if(isset($_GET['page']))
{
	switch ($_GET['page']) // on utilise ici un switch pour inclure telle ou telle page selon.
	{ 		
		// Quand un joueur veut accèder au profil de qqun ou le sien...
		case 'profil':
			include('controleur/profil/index.php');	
		break;	

		case 'messagerie':
			require('modele/app/messagerie.class.php');
			if(isset($_Joueur_['pseudo']))
				include('theme/' .$_Serveur_['General']['theme']. '/pages/messagerie.php');
			else
				header('Location: index.php');
		break;

		case 'chat':
			require('modele/app/chat.class.php');
			include('theme/'.$_Serveur_['General']['theme']. '/pages/chat.php');
		break;

		case 'membres':
			require('modele/app/membres.class.php');
			include('theme/'.$_Serveur_['General']['theme']. '/pages/membres.php');
		break;
		
		// Par exemple, lorsque le get[page] vaut boutique, on inclut la page boutique... Logique non?
		case 'boutique':  
			require_once('controleur/boutique/offres.php'); 
			include('theme/' .$_Serveur_['General']['theme']. '/pages/boutique.php');
		break;
		
		case 'panier':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/panier.php');
		break;
		
		// Pour le forum 
						
		case 'forum':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/forum.php');
		break;
		
		case 'signalement':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/signalement.php');
		break;
		
		case 'editForum':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/editForum.php');
		break;
		
		case 'forum_categorie':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/forum_categorie.php');
		break;
		
		case 'post':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/post.php');
		break;
		
		case 'confirmation':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/confirmation.php');
		break;
		
		case 'alert':
			include('theme/' .$_Serveur_['General']['theme']. '/pages/alert.php');
		break;
			
			// Fin du forum
		
		case 'admin': 
			include('controleur/admin/admin.php');
		break;

		case 'erreur':
		    include('controleur/erreur.php'); 
			$erreur = (!isset($_GET['erreur'])) ? 1500879564 : (int)$_GET['erreur'];
			unset($type);
			unset($titre);
			unset($contenue);
			get_erreur($erreur, $type, $titre, $contenue);
			include('theme/' .$_Serveur_['General']['theme']. '/pages/erreur.php');
		break;

		
		case 'token': 
			if(Permission::getInstance()->verifPerm("connect"))
			{
				if($_Serveur_['Payement']['paypal'])
					require_once('modele/tokens/paypal.php'); 
				if($_Serveur_['Payement']['paysafecard'])
					require_once('modele/tokens/paysafecard.php');
				include('theme/' .$_Serveur_['General']['theme']. '/pages/tokens.php');
			}
			else
				header('Location: ?page=erreur&erreur=19&titre='.urlencode("Erreur d'accès")."&type=".urlencode("Connexion requise")."&contenue=".urlencode("Vous devez être connecté pour accéder à cette page !"));
		break;
		
		case 'voter': 
			// include('controleur/topVoteurs.php');
			include('theme/' .$_Serveur_['General']['theme']. '/pages/voter.php');
		break;
		
		case 'support': 
			require_once('controleur/support/support.php');
			require_once('modele/forum/miseEnPage.php');
			include('theme/' .$_Serveur_['General']['theme']. '/pages/support.php');
		break;	
		
		case 'banlist': 
			require_once('controleur/app/banlist.php');
			include('theme/' .$_Serveur_['General']['theme']. '/pages/banlist.php');
		break;	
		
		case 'groups': 
			require_once('controleur/app/groupsList.php');
			include('theme/' .$_Serveur_['General']['theme']. '/pages/groupsList.php');
		break;	
				
		// Si jamais l'utilisateur à entré un Get inconnu, on lui met une petite erreur :p
		default:
			require_once('modele/page.class.php');
			$pageDataReq = new PageData($bddConnection);
			$pageDataReq = $pageDataReq->GetListPages(urldecode($_GET['page']));

			
			$pageData = $pageDataReq->fetch(PDO::FETCH_ASSOC);
			
				$pages['id'] = $pageData['id'];
				$pages['titre'] = $pageData['titre'];
				$pages['contenu'] = $pageData['contenu'];
				$pages['tableauPages'] = explode('#µ¤#', $pages['contenu']);
				for($j = 0; $j < count($pages['tableauPages']); $j++) 
					$pageContenu[$j] = explode('|;|', $pages['tableauPages'][$j]);
			
			if(!isset($pages) OR empty($pages))
			{
				include('controleur/erreur.php');
				$erreur = (!isset($_GET['erreur'])) ? 1500879564 : (int)$_GET['erreur'];
				unset($type);
				unset($titre);
				unset($contenue);
				get_erreur($erreur, $type, $titre, $contenue);
				include('theme/' .$_Serveur_['General']['theme']. '/pages/erreur.php');
			}
			else
				include('theme/' .$_Serveur_['General']['theme']. '/pages/standard.php');
	}
}

// Par défault (aucun get), on insère la page d'accueil !
else
{
	require_once('controleur/accueil.php');
	include('theme/' .$_Serveur_['General']['theme']. '/pages/accueil.php');
}
?>
