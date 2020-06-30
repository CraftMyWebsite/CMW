<?php
if(isset($_GET['page']))
{
	switch ($_GET['page']) // on utilise ici un switch pour inclure telle ou telle page selon.
	{ 		
		
		case 'accueil':
		echo '<link href="./admin/assets/css/page/style-accueil.css" rel="stylesheet">';
		require_once('./admin/donnees/informations.php'); 
		include('./admin/page/informations.php');
		break;

		case 'social':
			require_once('./admin/donnees/reseaux.php');
			include('./admin/page/reseaux.php');
		break;

		case 'boutiquelist':
			require_once('./admin/donnees/boutiquelist.php');
			include('./admin/page/boutiquelist.php');
		break;

		case 'modifIP':
			require_once('./admin/donnees/modifIP.php');
			include('./admin/page/modifIP.php');
		break;

		case 'configVoter':
			require_once('./admin/donnees/configVoter.php');
			include('./admin/page/configVoter.php');
		break;

		case 'ban':
			require_once('./admin/donnees/ban.php');
			include('./admin/page/ban.php');
		break;

		case 'forum':
			require_once('./admin/page/forum.php');
		break;
		case 'configsite':  
		require_once('./admin/donnees/general.php'); 
		include('./admin/page/general.php');
		break;

		case 'theme':
		require_once('./admin/donnees/theme.php'); 
		include('./admin/page/theme.php');
		break;

		case 'grade':
		require_once('./admin/donnees/grades.php'); 
		include('./admin/page/grades.php');
		break;

		case 'slidemini':
		require_once('./admin/donnees/accueil.php'); 
		include('./admin/page/accueil.php');
		break;

		case 'reglagejsonapi':
		require_once('./admin/donnees/regServeur.php'); 
		include('./admin/page/regServeur.php');
		break;

		case 'custompages':
		require_once('./admin/donnees/pages.php'); 
		include('./admin/page/pages.php');
		break;

		case 'news':
		require_once('./admin/donnees/news.php'); 
		include('./admin/page/news.php');
		break;

		case 'boutique':
		require_once('./admin/donnees/boutique.php'); 
		include('./admin/page/boutique.php');
		break;

		case 'paiement':
		require_once('./admin/donnees/payement.php'); 
		include('./admin/page/payement.php');
		break;

		case 'menus':
		require_once('./admin/donnees/menu.php'); 
		include('./admin/page/menu.php');
		break;

		case 'voter':
		require_once('./admin/donnees/voter.php'); 
		include('./admin/page/voter.php');
		break;

		case 'membres':
		require_once('./admin/donnees/membres.php'); 
		include('./admin/page/membres.php');
		break;

		case 'widgets':
		require_once('./admin/donnees/widgets.php'); 
		include('./admin/page/widgets.php');
		break;

		case 'support':
		require_once('./admin/donnees/support.php'); 
		include('./admin/page/support.php');
		break;

		case 'maintenance':
		require_once('./admin/donnees/maintenance.php'); 
		include('./admin/page/maintenance.php');
		break;

		case 'newsletter':
		// require_once('./admin/donnees/newsletter.php'); 
		include('./admin/page/newsletter.php');
		break;

		case 'upload':
		include('./admin/page/upload.php');
		break;

		case 'maj':  
		include('./admin/page/update.php');
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
	include('./admin/page/informations.php');
} 
?>