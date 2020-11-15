<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) 
{
	$configTheme = new Lire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml');
	$_Theme_ = $configTheme->GetTableau();

//====> MAIN PART (Choix du thèmes et couleur)

    //Application des couleurs du thème si non existant (Permet de customiser avec ses couleurs dans config.yml)

    if(isset($_POST['changeTheme'])) {

    	$theme = $_POST['changeTheme'];

    	if($theme === "light") {

    		$ecritureTheme['Main']['theme']["choosed-theme"] = 0;


    	} else {

    		$ecritureTheme['Main']['theme']["choosed-theme"] = 1;

    	}

    }


    if(!isset($_Theme_['Main']['theme']['light']) || !isset($_Theme_['Main']['theme']['dark'])) {

	    //Light Theme
	    $ecritureTheme['Main']['theme']['light']['main-color-bg'] = "#f1f1f1";
	    $ecritureTheme['Main']['theme']['light']['secondary-color-bg'] = "#c384d8";
	    $ecritureTheme['Main']['theme']['light']['base-color'] = "#190a0a";
	    $ecritureTheme['Main']['theme']['light']['main-color'] = "#a042bf";
	    $ecritureTheme['Main']['theme']['light']['active-color'] = "#8618aa";
	    $ecritureTheme['Main']['theme']['light']['darkest'] = "#d8d8d8";
	    $ecritureTheme['Main']['theme']['light']['lightest'] = "#c3c3c3";

	    //Dark Theme
	    $ecritureTheme['Main']['theme']['dark']['main-color-bg'] = "#333336";
	    $ecritureTheme['Main']['theme']['dark']['secondary-color-bg'] = "#c104ff";
	    $ecritureTheme['Main']['theme']['dark']['base-color'] = "#e0e0e0";
	    $ecritureTheme['Main']['theme']['dark']['main-color'] = "#e5a0fc";
	    $ecritureTheme['Main']['theme']['dark']['active-color'] = "#d457fd";
	    $ecritureTheme['Main']['theme']['dark']['darkest'] = "#3f3f3f";
	    $ecritureTheme['Main']['theme']['dark']['lightest'] = "#585858";
	
	}else {

	    $ecritureTheme['Main']['theme']['light']['main-color-bg'] = $_Theme_['Main']['theme']['light']['main-color-bg'];
	    $ecritureTheme['Main']['theme']['light']['secondary-color-bg'] = $_Theme_['Main']['theme']['light']['secondary-color-bg'];
	    $ecritureTheme['Main']['theme']['light']['base-color'] = $_Theme_['Main']['theme']['light']['base-color'];
	    $ecritureTheme['Main']['theme']['light']['main-color'] = $_Theme_['Main']['theme']['light']['main-color'];
	    $ecritureTheme['Main']['theme']['light']['active-color'] = $_Theme_['Main']['theme']['light']['active-color'];
	    $ecritureTheme['Main']['theme']['light']['darkest'] = $_Theme_['Main']['theme']['light']['darkest'];
	    $ecritureTheme['Main']['theme']['light']['lightest'] = $_Theme_['Main']['theme']['light']['lightest'];

	    //Dark Theme
	    $ecritureTheme['Main']['theme']['dark']['main-color-bg'] = $_Theme_['Main']['theme']['dark']['main-color-bg'];
	    $ecritureTheme['Main']['theme']['dark']['secondary-color-bg'] = $_Theme_['Main']['theme']['dark']['secondary-color-bg'];
	    $ecritureTheme['Main']['theme']['dark']['base-color'] = $_Theme_['Main']['theme']['dark']['base-color'];
	    $ecritureTheme['Main']['theme']['dark']['main-color'] = $_Theme_['Main']['theme']['dark']['main-color'];
	    $ecritureTheme['Main']['theme']['dark']['active-color'] = $_Theme_['Main']['theme']['dark']['active-color'];
	    $ecritureTheme['Main']['theme']['dark']['darkest'] = $_Theme_['Main']['theme']['dark']['darkest'];
	    $ecritureTheme['Main']['theme']['dark']['lightest'] = $_Theme_['Main']['theme']['dark']['lightest'];

	}

//FOOTER PART (Choix des réseaux et du "A Propos")


    $ecritureTheme['Pied']['about'] = nl2br(htmlspecialchars($_POST['about']));
    $ecritureTheme['Pied']['social'] = json_decode($_POST['jsonReseau'], true);

    $ecriture = new Ecrire('theme/'.$_Serveur_['General']['theme'].'/config/config.yml', $ecritureTheme);

}
?>
