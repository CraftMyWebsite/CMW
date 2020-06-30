<?php
// On inclut le fichier de contrôle de la maintenance
include('controleur/maintenance.php');
// Si la maintenance est activé
if($maintenance[$i]['maintenanceEtat'] == 1){
	// On vérifie si le joueur est connecté
	if(!(isset($_Joueur_))){
		header('Location: index.php?&redirection=maintenance');
	} elseif($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['access'] == true) { // On vérifie si il est admin
		if( $maintenance[$i]['maintenancePref'] == 0 ){ // Si la pref vaut 0 les admins ont accès au site avec l'entête en plus
		include('theme/' .$_Serveur_['General']['theme']. '/maintenance/entete.php');
		} elseif ( $maintenance[$i]['maintenancePref'] == 1 ) { // Si la maintenance vaut 1 les admins n'ont pas accès au site mais ils sont redirigés vers le panel admin
		header('Location: admin.php');
		}
			else { // Si le joueur n'est pas admin il est redirigé vers la page de maintenance
			header('Location: index.php?&redirection=maintenance');
		}
	} else { // Si le joueur n'est pas connecté il est redirigé vers la page de maintenance
	header('Location: index.php?&redirection=maintenance');
}
}
if(isset($_Joueur_))
{
	require('modele/forum/joueurforum.class.php');
	$_JoueurForum_ = new JoueurForum($_Joueur_['pseudo'], $_Joueur_['id'], $bddConnection);
}
require('modele/forum/forum.class.php');
$_Forum_ = new Forum($bddConnection);
?>