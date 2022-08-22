<?php
/*
	Ce fichier PHP effectue telle ou telle action selon le contenu des gets envoyés par la theme(selon le lien sur lequel l'utilisateur à cliqué etc...).
*/

unset($_SESSION['referrerAdmin']);
if(isset($_GET['action']) AND $_Permission_->verifPerm("PermsPanel", "access"))
{
	switch ($_GET['action']) // on utilise ici un switch pour inclure telle ou telle page selon l'action.
	{ 
	    
	    case 'getUrlContent':
	    	require('admin/actions/getUrlContent.php');
	    	exit();
	    case 'mooveWidgets':
	        require('admin/actions/mooveWidgets.php');
	        exit();
	    case 'addWidgets':
	    	require('admin/actions/addWidgets.php');
	    	exit();
	    case 'editWidgets':
	    	require('admin/actions/editWidgets.php');
	    	exit();
	    case 'supprWidgets':
	    	require('admin/actions/supprWidgets.php');
	    	exit();
	    case 'mooveMenu':
	        require('admin/actions/mooveMenu.php');
	        exit();
	    case 'mooveMinia':
	        require('admin/actions/mooveMinia.php');
	        exit();
		case 'supprUpload': 
			require('admin/actions/supprUpload.php');
			exit();
		case 'editUploadImage':
		    require('admin/actions/editUploadImage.php');
			exit();
		case 'resetAllUploadImage':
			require('admin/actions/resetAllUploadImage.php');
			exit();
		case 'EnableShowTopVote':
		    require('admin/actions/EnableShowTopVote.php');
			exit();
		case 'DisableShowTopVote':
		    require('admin/actions/DisableShowTopVote.php');
			exit();
		case 'switchUploadImage':
		    require('admin/actions/switchUploadImage.php');
			exit();
		case 'editResetVote':
			require('admin/actions/editResetVote.php');
			exit();
		case 'editTopVoteNumber':
		    require('admin/actions/editTopVoteNumber.php');
			exit();
		case 'suppVoteHistory':
		    require('admin/actions/suppVoteHistory.php');
			exit();
		case 'suppOldVoteHistory':
		    require('admin/actions/suppOldVoteHistory.php');
			exit();
		case 'switchPreferenceInscription':
			require('admin/actions/switchPreferenceInscription.php');
			exit();
		case 'editMessageInscr':
			require('admin/actions/editMessageInscr.php');
			exit();
		case 'suppAllVoteHistory':
		    require('admin/actions/suppAllVoteHistory.php');
			exit();
		case 'suppAllOldVoteHistory':
		    require('admin/actions/suppAllOldVoteHistory.php');
			exit();
		case 'supprHistoPaypal':
		    require('admin/actions/supprHistoPaypal.php');
			exit();
		case 'getJsonVoteHistory':
			require('admin/actions/getJsonVoteHistory.php');
			exit();
		case 'getGradesList':
			require('admin/actions/getGradesList.php');
			exit();
		case 'getPagesList':
			require('admin/actions/getPagesList.php');
			exit();
		case 'getJsonMember':
			require('admin/actions/getJsonMember.php');
			exit();
		case 'getLienVote':
			require('admin/actions/getLienVote.php');
			exit();
		case 'getJsonAchat':
			require('admin/actions/getJsonAchat.php');
			exit();
		case 'getOffreBoutique':
			require('admin/actions/getOffreBoutique.php');
			exit();
		case 'getOffreActionBoutique':
			require('admin/actions/getOffreActionBoutique.php');
			exit();
		case 'getServerList':
			require('admin/actions/getServerList.php');
			exit();
		case 'getOffrePaypal':
			require('admin/actions/getOffrePaypal.php');
			exit();
		case 'getWidgetsList':
			require('admin/actions/getWidgetsList.php');
			exit();
		case 'getRecompenseList':
			require('admin/actions/getRecompenseList.php');
			exit();
		case 'getMenuListe':
			require('admin/actions/getMenuListe.php');
			exit();
		case 'changeVoteCron':
			require('admin/actions/changeVoteCron.php');
		break;
		case 'dropVisits':
			if($_Permission_->verifPerm("PermsPanel", "info", "stats", "visitors", "showTable"))
				$bddConnection->exec('TRUNCATE cmw_visits');
			exit();
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

		case 'supprMiniature':
			require('admin/actions/supprMiniature.php');
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

		case 'commande': 
			require('admin/actions/commande.php');
		break;

		case 'changeNom':
			require('admin/actions/nom.php');
		break;

		case 'modifierVote':
			require('admin/actions/modifierVote.php');
		break;

		case 'supprAllTickets':
			require('admin/actions/supprAllTickets.php');
		break;

		case 'switchTypeSupport':
			require('admin/actions/switchTypeSupport.php');
		break;

		case 'addPrefix':
			require('admin/actions/addPrefix.php');
		break;

		case 'supprPrefix':
			require('admin/actions/supprPrefix.php');
		break;

		case 'configTheme':
			require('theme/'.$_Serveur_['General']['theme'].'/config/configAdminTraitement.php');
		break;

		case 'creerCoupon':
			require('admin/actions/creerCoupon.php');
		break;

		case 'creerPostit':
			require('admin/actions/creerPostit.php');
		break;

		case 'supprPostit':
			require('admin/actions/supprPostit.php');
		break;

		case 'supprCoupon':
			require('admin/actions/supprCoupon.php');
		break;

		case 'ajout_favicon':
			require('admin/actions/ajout_favicon.php');
		break;
		
		case 'general': 
			require('admin/actions/general.php');
		break;


		case 'editBdd': 
			require('admin/actions/editBdd.php');
		break;
		
		case 'editTheme': 
			require('admin/actions/editTheme.php');
		break;
		
		case 'themeColor': 
			require('admin/actions/themeColor.php');
		break;
		
		case 'supprMembre': 
			require('admin/actions/supprMembre.php');
		break;
		
		case 'validMail': 
			require('admin/actions/validMail.php');
		break;
		
		case 'modifierMembres': 
			require('admin/actions/modifierMembres.php');
			exit();
		break;
		
		case 'creerPage': 
			require('admin/actions/creerPage.php');
		break;
		
		case 'supprPage': 
			require('admin/actions/supprPage.php');
		break;
		
		case 'editBoutique': 
			require('admin/actions/editBoutique.php');
		break;
		
		case 'supprCategorie': 
			require('admin/actions/supprCategorie.php');
		break;
		
		case 'supprAction': 
			require('admin/actions/supprAction.php');
		break;
		
		case 'editerAction': 
			require('admin/actions/editerAction.php');
		break;
		
		case 'serveurJsonNew': 
			require('admin/actions/serveurJsonNew.php');
		break;
		
		case 'serveurConfig': 
			require('admin/actions/serveurConfig.php');
		break;
		
		case 'supprJson': 
			require('admin/actions/serveurJsonSuppr.php');
		break;
		
		case 'addMenu': 
			require('admin/actions/addMenu.php');
		break;
		
		case 'editPayement': 
			require('admin/actions/editPayement.php');
		break;
		
		case 'creerOffrePaypal': 
			require('admin/actions/creerOffrePaypal.php');
		break;
		
		case 'modifierOffrePaypal': 
			require('admin/actions/modifierOffrePaypal.php');
		break;

		case 'validerPaysafecard':
			require('admin/actions/validerPaysafecard.php');
		break;

		case 'supprHistoPaysafecard':
			require('admin/actions/supprHistoPaysafecard.php');
		break;

		case 'modifierOffrePaysafecard':
			require('admin/actions/paysafecard.php');
		break;
		
		case 'supprimerPaypalOffre': 
			require('admin/actions/supprimerPaypalOffre.php');
		break;
		
		
		case 'supprMenu': 
			require('admin/actions/supprMenu.php');
		break;
		
		case 'modifierLien': 
			require('admin/actions/modifierLien.php');
		break;
		
		case 'editMenu': 
			require('admin/actions/editMenu.php');
		break;
				
		case 'deplacerMenu': 
			require('admin/actions/deplacerMenu.php');
		break;
		
		case 'postMiniature': 
			require('admin/actions/postMiniature.php');
		break;

		case 'postNews': 
			require('admin/actions/postNews.php');
		break;
		
		case 'supprNews': 
			require('admin/actions/supprNews.php');
		break;
		
		case 'creerCategorie': 
			require('admin/actions/creerCategorie.php');
		break;
		
		case 'creerOffre': 
			require('admin/actions/creerOffre.php');
		break;
		
		case 'creerAction': 
			require('admin/actions/creerAction.php');
		break;
		
		case 'editMiniature': 
			require('admin/actions/editMiniature.php');
		break;
		
		case 'addMiniature': 
			require('admin/actions/addMiniature.php');
		break;
		
		case 'newSlider':
			require('admin/actions/newSlider.php');
		break;
		
		case 'changeSlider':
			require('admin/actions/changeSlider.php');
		break;

		
		case 'supprSlider':
			require('admin/actions/supprSlider.php');
		break; 
		
		case 'postBG':
			require('admin/actions/postBG.php');
		break; 

		case 'typeBG':
			require('admin/actions/postBG.php');
		break; 
		
		case 'creerLienVote':
			require('admin/actions/creerLienVote.php');
		break;
		
		case 'supprVote':
			require('admin/actions/supprVote.php');
		break;
		
		case 'editPage':
			require('admin/actions/editPage.php');
		break;
		
		case 'supprTicket':
			require('admin/actions/supprTicket.php');
		break;
		
		case 'editNews':
			require('admin/actions/editNews.php');
		break;

		case 'resetVotes':
			if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote'))
			{
				$bddConnection->exec('DELETE FROM cmw_votes');
			}
		break;

		case 'resetVotesConfig':
			if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote'))
			{
				$bddConnection->exec('DELETE FROM cmw_votes_config');
			}
		break;

		
		case 'etatTickets':
			require('admin/actions/etatTickets.php');
		break;

		case 'switchMaintenance':
			require('admin/actions/switchMaintenance.php');
		break;
		
		case 'switchPreference':
			require('admin/actions/switchPreference.php');
		break;

		case 'editMessage':
			require('admin/actions/editMessage.php');
		break;

		case 'editMessageAdmin':
			require('admin/actions/editMessageAdmin.php');
		break;

		case 'commandeConsole': 
			require('admin/actions/commandeConsole.php');
		break;

		case 'commandeRechargementPlugins': 
			require('admin/actions/commandeRechargementPlugins.php');
		break;

		case 'commandeRedemarrageServer': 
			require('admin/actions/commandeRedemarrageServer.php');
		break;

		case 'switchSysMail': 
			require('admin/actions/switchSysMail.php');
		break;

		case 'editSysMail': 
			require('admin/actions/editSysMail.php');
		break;

		case 'editNbrPerIP': 
			require('admin/actions/editNbrPerIP.php');
		break;

		case 'supprGrade': 
			require('admin/actions/supprGrade.php');
		break;

		case 'addGrade': 
			require('admin/actions/addGrade.php');
		break;

		case 'editGrade': 
			require('admin/donnees/grades.php');
			require('admin/actions/editGrade.php');
		break;

		case 'newsletter': 
			require('admin/actions/newsletter.php');
		exit();
		
		break;

		case 'uploadImg': 
			require('admin/actions/uploadImg.php');
		break;

		case 'boutique':
			require('admin/actions/boutique.php');
		break;
		
		case 'switchGoogleAdsense':
		    require('admin/actions/switchGoogleAdsense.php');
		break;
		
		case 'switchGoogleAnalytics':
		    require('admin/actions/switchGoogleAnalytics.php');
		break;
		
		case 'switchGoogleSearchConsole':
		    require('admin/actions/switchGoogleSearchConsole.php');
		break;
		
		case 'editGoogleAdsense':
		    require('admin/actions/editGoogleAdsense.php');
		break;
		
		case 'editGoogleAnalytics':
		    require('admin/actions/editGoogleAnalytics.php');
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