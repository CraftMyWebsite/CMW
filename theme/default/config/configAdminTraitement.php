<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) 
{
	$configTheme = new Lire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml');
	$_Theme_ = $configTheme->GetTableau();

	require_once("modele/app/ckeditor.class.php");

 	$_Theme_['Pied']['about'] = ckeditor::verif($_POST['about'],true);
    $_Theme_['Pied']['social'] = json_decode($_POST['jsonReseau'], true);



	$_Theme_['Main']['theme']['couleurs']['main-color-bg'] = $_POST['main-color-bg'];
	$_Theme_['Main']['theme']['couleurs']['secondary-color-bg'] = $_POST['secondary-color-bg'];
	$_Theme_['Main']['theme']['couleurs']['base-color'] = $_POST['base-color'];
	$_Theme_['Main']['theme']['couleurs']['main-color'] = $_POST['main-color'];
	$_Theme_['Main']['theme']['couleurs']['active-color'] = $_POST['active-color'];
	$_Theme_['Main']['theme']['couleurs']['darkest'] = $_POST['darkest'];
	$_Theme_['Main']['theme']['couleurs']['lightest'] = $_POST['lightest'];

	$_Theme_['Main']['theme']['police'] = $_POST['police'];

	$ecriture = new Ecrire('theme/default/config/config.yml', $_Theme_);

}
?>
