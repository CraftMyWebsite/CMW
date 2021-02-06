<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) 
{
	$configTheme = new Lire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml');
	$_Theme_ = $configTheme->GetTableau();

//====> MAIN PART (Choix du thèmes et couleur)


//FOOTER PART (Choix des réseaux et du "A Propos")


    $ecritureTheme['Pied']['about'] = nl2br(htmlspecialchars($_POST['about']));
    $ecritureTheme['Pied']['social'] = json_decode($_POST['jsonReseau'], true);

    $ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);



// Modification couleurs du thème

	// Light Thème
	$_Theme_['Main']['theme']['couleurs']['main-color-bg'] = $_POST['main-color-bg'];
	$_Theme_['Main']['theme']['couleurs']['secondary-color-bg'] = $_POST['secondary-color-bg'];
	$_Theme_['Main']['theme']['couleurs']['base-color'] = $_POST['base-color'];
	$_Theme_['Main']['theme']['couleurs']['main-color'] = $_POST['main-color'];
	$_Theme_['Main']['theme']['couleurs']['active-color'] = $_POST['active-color'];
	$_Theme_['Main']['theme']['couleurs']['darkest'] = $_POST['darkest'];
	$_Theme_['Main']['theme']['couleurs']['lightest'] = $_POST['lightest'];




	$ecriture = new Ecrire('theme/default/config/config.yml', $_Theme_);



}
?>
