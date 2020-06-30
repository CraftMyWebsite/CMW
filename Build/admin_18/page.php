<?php
if(isset($_GET['page']))
{
	switch ($_GET['page']) // on utilise ici un switch pour inclure telle ou telle page selon.
	{ 		
		
		case 'accueil':
		require_once('./admin/donnees/informations.php'); 
		include('./admin/pages/informations.php');
		break;

		case 'social':
			require_once('./admin/donnees/reseaux.php');
			include('./admin/pages/reseaux.php');
		break;

		case 'boutiquelist':
			echo '<link rel="stylesheet" href="./admin/assets/css/boutiquelist.css">';
			require_once('./admin/donnees/boutiquelist.php');
			include('./admin/pages/boutiquelist.php');
		break;

		case 'modifIP':
			require_once('./admin/donnees/modifIP.php');
			include('./admin/pages/modifIP.php');
		break;

		case 'configVoter':
			require_once('./admin/donnees/configVoter.php');
			include('./admin/pages/configVoter.php');
		break;

		case 'ban':
			require_once('./admin/donnees/ban.php');
			include('./admin/pages/ban.php');
		break;

		case 'forum':
			require_once('./admin/pages/forum.php');
		break;
		case 'configsite':  
			include('./admin/pages/general.php');
		break;

		case 'theme':
		require_once('./admin/donnees/theme.php'); 
		include('./admin/pages/theme.php');
		break;

		case 'grade':
		require_once('./admin/donnees/grades.php'); 
		include('./admin/pages/grades.php');
		break;

		case 'slidemini':
		require_once('./admin/donnees/accueil.php'); 
		include('./admin/pages/accueil.php');
		break;

		case 'reglagejsonapi':
		require_once('./admin/donnees/regServeur.php'); 
		include('./admin/pages/regServeur.php');
		break;

		case 'custompages':
		require_once('./admin/donnees/pages.php'); 
		include('./admin/pages/pages.php');
		break;

		case 'news':
		require_once('./admin/donnees/news.php'); 
		include('./admin/pages/news.php');
		break;

		case 'boutique':
		require_once('./admin/donnees/boutique.php'); 
		include('./admin/pages/boutique.php');
		break;

		case 'paiement':
		require_once('./admin/donnees/payement.php'); 
		include('./admin/pages/payement.php');
		break;

		case 'menus':
		require_once('./admin/donnees/menu.php'); 
		include('./admin/pages/menu.php');
		break;

		case 'voter':
		require_once('./admin/donnees/voter.php'); 
		include('./admin/pages/voter.php');
		break;

		case 'membres':
		require_once('./admin/donnees/membres.php'); 
		include('./admin/pages/membres.php');
		break;

		case 'widgets':
		require_once('./admin/donnees/widgets.php'); 
		include('./admin/pages/widgets.php');
		break;

		case 'support':
		require_once('./admin/donnees/support.php'); 
		include('./admin/pages/support.php');
		break;

		case 'maintenance':
		require_once('./admin/donnees/maintenance.php'); 
		include('./admin/pages/maintenance.php');
		break;

		case 'newsletter':
		// require_once('./admin/donnees/newsletter.php'); 
		include('./admin/pages/newsletter.php');
		break;

		case 'upload':
		include('./admin/pages/upload.php');
		break;

		case 'maj':  
		include('./admin/pages/update.php');
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
			include('theme/' .$_Serveur_['General']['theme']. '/pages/erreur.php');
		}
		else
			include('theme/' .$_Serveur_['General']['theme']. '/pages/standard.php');
	}
} else {
	require_once('./admin/donnees/informations.php'); 
	include('./admin/pages/informations.php');
} 
?>