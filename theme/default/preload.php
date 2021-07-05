<?php
require("modele/menu.class.php");
$_Menu_ = new menu($bddConnection);
$_Menu_ = $_Menu_->getMenuGroup();

require("modele/accueil/miniature.class.php");
$_Minia_ = new miniature($bddConnection);
$_Minia_ = $_Minia_->getMinia();

require("modele/widgets.class.php");
$_Widgets_ = new widgets($bddConnection);
$_Widgets_ = $_Widgets_->getWidgets();


// On inclut le fichier de contrôle de la maintenance
include('controleur/maintenance.php');
// Si la maintenance est activé
if($maintenance[$i]['maintenanceEtat'] == 1){
	// On vérifie si le joueur est connecté
	if(!(isset($_Joueur_))){
		header('Location: index.php?page=maintenance');
	} elseif(Permission::getInstance()->verifPerm('PermsPanel', 'maintenance', 'actions', 'connexionAdmin')) { // On vérifie si il est admin
		if( $maintenance[$i]['maintenancePref'] == 0 ){ // Si la pref vaut 0 les admins ont accès au site avec l'entête en plus
		include('theme/' .$_Serveur_['General']['theme']. '/maintenance/entete.php');
		} elseif ( $maintenance[$i]['maintenancePref'] == 1 ) { // Si la maintenance vaut 1 les admins n'ont pas accès au site mais ils sont redirigés vers le panel admin
		header('Location: admin.php');
		}
			else { // Si le joueur n'est pas admin il est redirigé vers la page de maintenance
			header('Location: index.php?page=maintenance');
		}
	} else { // Si le joueur n'est pas connecté il est redirigé vers la page de maintenance
	header('Location: index.php?page=maintenance');
}
}
if(Permission::getInstance()->verifPerm("connect"))
{
	require('modele/forum/joueurforum.class.php');
	$_JoueurForum_ = new JoueurForum($_Joueur_['pseudo'], $_Joueur_['id'], $bddConnection);
}
require('modele/forum/forum.class.php');
$_Forum_ = new Forum($bddConnection);
?>