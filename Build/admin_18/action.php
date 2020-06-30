<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/

unset($_SESSION['referrerAdmin']);
if(isset($_GET['action']) AND Permission::getInstance()->verifPerm("PermsPanel", "access"))
{
	switch ($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{ 
		case 'getJsonMember':
			require('admin/actions/getJsonMember.php');
			exit();
		case 'getJsonAchat':
			require('admin/actions/getJsonAchat.php');
			exit();
		case 'getOffreBoutique':
			require('admin/actions/getOffreBoutique.php');
			exit();
		case 'changeVoteCron':
			require('admin/actions/changeVoteCron.php');
		break;
		case 'dropVisits':
			if(Permission::getInstance()->verifPerm("PermsPanel", "info", "stats", "visitors", "showTable"))
				$bddConnection->exec('TRUNCATE cmw_visits');
		break;

		case 'removeSocial':
			require('admin/actions/removeSocial.php');
		break;

		case 'getNewsList':
			require('admin/actions/getNewsList.php');
		break;

		case 'getMiniaList':
			require('admin/actions/getMiniaList.php');
		break;

		case 'testMail':
			require('admin/actions/testMail.php');
		break;

		case 'editMail':
			require('admin/actions/editMail.php');
		break;
		
		case 'epingle':
			require('admin/actions/epingleNews.php');
		break;

		case 'getBoutiqueListe':
			require('admin/actions/getBoutiqueListe.php');
		break;

		case 'supprMini':
			require('admin/actions/supprMini.php');
		break;

		case 'addSocial':
			require('admin/actions/addSocial.php');
		break;

		case 'supprRecAuto':
			require('admin/actions/supprRecAuto.php');
		break;

		case 'creerLienVote':
			require('admin/actions/creerLienVote.php');
		break;

		case 'creerRecompenseAuto':
			require('admin/actions/creerRecompenseAuto.php');
		break;

		case 'addBan':
			require('admin/actions/addBan.php');
		break;

		case 'removeBan':
			require('admin/actions/removeBan.php');
		break;

		case 'pageBan':
			require('admin/actions/pageBan.php');
		break;

		case 'removeSocial':
			if(Permission::getInstance()->verifPerm('PermsPanel', 'social', 'showPage'))
				$bddConnection->exec('ALTER TABLE cmw_reseaux DROP '.$_POST['nom']);
		break;

		case 'commande': 
			require_once('admin/actions/commande.php');
		break;

		case 'changeNom':
			require_once('admin/actions/nom.php');
		break;

		case 'modifierVote':
			require_once('admin/actions/modifierVote.php');
		break;

		case 'supprAllTickets':
			require_once('admin/actions/supprAllTickets.php');
		break;

		case 'switchTypeSupport':
			require_once('admin/actions/switchTypeSupport.php');
		break;

		case 'addPrefix':
			require_once('admin/actions/addPrefix.php');
		break;

		case 'supprPrefix':
			require_once('admin/actions/supprPrefix.php');
		break;

		case 'configTheme':
			require_once('theme/'.$_Serveur_['General']['theme'].'/config/configAdminTraitement.php');
			$_SESSION['referrerAdmin'] = 'theme';
		break;

		case 'addSmiley':
			require_once('admin/actions/addSmiley.php');
		break;

		case 'supprSmiley':
			require_once('admin/actions/supprSmiley.php');
		break;

		case 'creerCoupon':
			require_once('admin/actions/creerCoupon.php');
		break;

		case 'creerPostit':
			require_once('admin/actions/creerPostit.php');
		break;

		case 'supprPostit':
			require_once('admin/actions/supprPostit.php');
		break;

		case 'supprCoupon':
			require_once('admin/actions/supprCoupon.php');
		break;

		case 'ajout_favicon':
			require_once('admin/actions/ajout_favicon.php');
		break;
		
		case 'general': 
			require_once('admin/actions/general.php');
		break;


		case 'editBdd': 
			require_once('admin/actions/editBdd.php');
		break;
		
		case 'editTheme': 
			require_once('admin/actions/editTheme.php');
		break;
		
		case 'themeColor': 
			require_once('admin/actions/themeColor.php');
		break;
		
		case 'supprMembre': 
			require_once('admin/actions/supprMembre.php');
		break;
		
		case 'validMail': 
			require_once('admin/actions/validMail.php');
		break;
		
		case 'modifierMembres': 
			require_once('admin/actions/modifierMembres.php');
			exit();
		break;
		
		case 'creerPage': 
			require_once('admin/actions/creerPage.php');
		break;
		
		case 'supprPage': 
			require_once('admin/actions/supprPage.php');
		break;
		
		case 'boutique': 
			require_once('admin/actions/boutique.php');
		break;
		
		case 'supprCategorie': 
			require_once('admin/actions/supprCategorie.php');
		break;
		
		case 'supprAction': 
			require_once('admin/actions/supprAction.php');
		break;
		
		case 'editerAction': 
			require_once('admin/actions/editerAction.php');
		break;
		
		case 'serveurJsonNew': 
			require_once('admin/actions/serveurJsonNew.php');
		break;
		
		case 'serveurConfig': 
			require_once('admin/actions/serveurConfig.php');
		break;
		
		case 'supprJson': 
			require_once('admin/actions/serveurJsonSuppr.php');
		break;
		
		case 'newLienMenu': 
			require_once('admin/actions/newLienMenu.php');
		break;
		
		case 'editPayement': 
			require_once('admin/actions/editPayement.php');
		break;
		
		case 'creerOffrePaypal': 
			require_once('admin/actions/creerOffrePaypal.php');
		break;
		
		case 'modifierOffrePaypal': 
			require_once('admin/actions/modifierOffrePaypal.php');
		break;
		
		case 'supprimerPaypalOffre': 
			require_once('admin/actions/supprimerPaypalOffre.php');
		break;
		
		case 'supprLienMenu': 
			require_once('admin/actions/supprLienMenu.php');
		break;
		
		case 'supprLienMenuDeroulant': 
			require_once('admin/actions/supprLienMenuDeroulant.php');
		break;
		
		case 'newListeMenu': 
			require_once('admin/actions/newListeMenu.php');
		break;
		
		case 'modifierLien': 
			require_once('admin/actions/modifierLien.php');
		break;
		
		case 'editMenuListe': 
			require_once('admin/actions/editMenuListe.php');
		break;
		
		case 'nouveauMenuListeLien': 
			require_once('admin/actions/nouveauMenuListeLien.php');
		break;
		
		case 'deplacerMenu': 
			require_once('admin/actions/deplacerMenu.php');
		break;
		
		case 'postNavRap': 
			require_once('admin/actions/postNavRap.php');
		break;

		case 'postNews': 
			require_once('admin/actions/postNews.php');
		break;
		
		case 'supprNews': 
			require_once('admin/actions/supprNews.php');
		break;
		
		case 'creerCategorie': 
			require_once('admin/actions/creerCategorie.php');
		break;
		
		case 'creerOffre': 
			require_once('admin/actions/creerOffre.php');
		break;
		
		case 'creerAction': 
			require_once('admin/actions/creerAction.php');
		break;
		
		case 'editRapNav': 
			require_once('admin/actions/editRapNav.php');
		break;
		
		case 'addRapNav': 
			require_once('admin/actions/addRapNav.php');
		break;
		
		case 'newSlider':
			require_once('admin/actions/newSlider.php');
		break;
		
		case 'changeSlider':
			require_once('admin/actions/changeSlider.php');
		break;
		
		case 'postSlider':
			require_once('admin/actions/postSlider.php');
		break; 
		
		case 'supprSlider':
			require_once('admin/actions/supprSlider.php');
		break; 
		
		case 'postBG':
			require_once('admin/actions/postBG.php');
		break; 

		case 'typeBG':
			require_once('admin/actions/postBG.php');
		break; 
		
		case 'creerLienVote':
			require_once('admin/actions/creerLienVote.php');
		break;
		
		case 'supprVote':
			require_once('admin/actions/supprVote.php');
		break;
		
		case 'editPage':
			require_once('admin/actions/editPage.php');
		break;
		
		case 'creerSection':
			require_once('admin/actions/creerSection.php');
		break;
		
		case 'supprSection':
			require_once('admin/actions/supprSection.php');
		break;
		
		case 'editPermissions':
			require_once('admin/actions/editPermissions.php');
		break;
		
		case 'supprTicket':
			require_once('admin/actions/supprTicket.php');
		break;
		
		case 'newWidget':
			require_once('admin/actions/newWidget.php');
		break;
		
		case 'supprWidget':
			require_once('admin/actions/supprWidget.php');
		break;
		
		case 'upWidget':
			require_once('admin/actions/upWidget.php');
		break;
		
		case 'downWidget':
			require_once('admin/actions/downWidget.php');
		break;
		
		case 'editNews':
			require_once('admin/actions/editNews.php');
		break;

		case 'resetVotes':
			if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote'))
			{
				$bddConnection->exec('DELETE FROM cmw_votes');
			}
		break;
		
		case 'etatTickets':
			require_once('admin/actions/etatTickets.php');
		break;

		case 'switchMaintenance':
			require_once('admin/actions/switchMaintenance.php');
		break;
		
		case 'switchPreference':
			require_once('admin/actions/switchPreference.php');
		break;

		case 'editMessage':
			require_once('admin/actions/editMessage.php');
		break;

		case 'editMessageAdmin':
			require_once('admin/actions/editMessageAdmin.php');
		break;

		case 'commandeConsole': 
			require_once('admin/actions/commandeConsole.php');
		break;

		case 'commandeRechargementPlugins': 
			require_once('admin/actions/commandeRechargementPlugins.php');
		break;

		case 'commandeRedemarrageServer': 
			require_once('admin/actions/commandeRedemarrageServer.php');
		break;

		case 'switchSysMail': 
			require_once('admin/actions/switchSysMail.php');
		break;

		case 'editSysMail': 
			require_once('admin/actions/editSysMail.php');
		break;

		case 'editNbrPerIP': 
			require_once('admin/actions/editNbrPerIP.php');
		break;

		case 'supprGrade': 
			require_once('admin/actions/supprGrade.php');
		break;

		case 'addGrade': 
			require_once('admin/actions/addGrade.php');
		break;

		case 'editGrade': 
			if(isset($_POST['Createur']))
			{
				require_once('admin/actions/nom.php');
			}
			elseif(isset($_POST['Joueur']))
			{
				require_once('admin/actions/nomJoueur.php');
			}
			else
			{
				require_once('admin/actions/editGrade.php');
			}
		break;

		case 'newsletter': 
			require_once('admin/actions/newsletter.php');
		exit();
		
		break;

		case 'uploadImg': 
			require_once('admin/actions/uploadImg.php');
		break;
		
		// Si le joueur a rentré un url contenant une valeur d'action innexistant?
		default:
			header('Location: admin.php');
	}
}
if(isset($_SESSION['referrerAdmin']))
	header('Location: admin.php?page='.$_SESSION['referrerAdmin']);
else
	exit();

?>
